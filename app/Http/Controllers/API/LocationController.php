<?php

namespace App\Http\Controllers\API;

use App\Warehouse;
use App\Section;
use App\Aisle;
use App\Column;
use App\Row;
use App\ProductLocation;
use App\ProductWarehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $warehouseID = $request->warehouse;

        $locations;

        if(isset($request->search)) {
            $locations = Warehouse::with('section.aisle.column.row')
                    ->whereHas('product', function (Builder $query) use ($search) {
                        $query->where('name', 'like','%'.$search.'%');
                    })
                    ->where('id',  $warehouseID)
                    ->get();
        }

        $locations = Warehouse::with('section.aisle.column.row')
                    ->where('id', $warehouseID)
                    ->get();

        $items = [];
        foreach ($locations[0]->section as $section_key => $section) {
            foreach ($section->aisle as $aisle_key => $aisle) {
                foreach ($aisle->column as $column_key => $column) {
                    foreach ($column->row as $row_key => $row) {
                        array_push($items, [
                            'warehouseID' => $warehouseID,
                            'sectionID' => $section->id,
                            'aisleID' => $aisle->id,
                            'columnID' => $column->id,
                            'rowID' => $row->id,

                            'section' => $section->code,
                            'aisle' => $aisle->number,
                            'column' => $column->number,
                            'row' => $row->number,

                            'location' => $section->code."-".$aisle->number."-".$column->number."-".$row->number
                        ]);
                    }
                }
            }
        }

        $total = count($items);
        $perPage = 15;
        $currentPage = $request->page ? $request->page : 1;
        $path = "http://127.0.0.1:8000/api/location";

        $paginator = new LengthAwarePaginator($items, $total, $perPage, $currentPage);
        $paginator->setPath($path);

        return $paginator;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = Section::where('warehouseID', $request['warehouseID'])->where('code', $request['section'])->first();

        if($section) {
            $aisle = Aisle::where('sectionID', $section->id)->where('number', $request['aisle'])->first();

            if($aisle) {
                $column = Column::where('aisleID', $aisle->id)->where('number', $request['column'])->first();

                if($column) {
                    $row = Row::where('columnID', $column->id)->where('number', $request['row'])->first();

                    if($row) {
                        return ['section' => $section, 'aisle' => $aisle, 'column' => $column, 'row' => $row];
                    }
                    else {
                        $row = new Row();

                        $row->number = $request->row;
                        $row->columnID = $column->id;

                        $row->save();

                        return ['section' => $section, 'aisle' => $aisle, 'column' => $column, 'row' => $row];
                    }
                }
                else {
                    $column = new Column();
                    $row = new Row();

                    $column->number = $request->column;
                    $column->aisleID = $aisle->id;

                    $column->save();

                    $row->number = $request->row;
                    $row->columnID = $column->id;

                    $row->save();

                    return ['section' => $section, 'aisle' => $aisle, 'column' => $column, 'row' => $row];
                }
            }
            else {
                $aisle = new Aisle();
                $column = new Column();
                $row = new Row();

                $aisle->number = $request->aisle;
                $aisle->sectionID = $section->id;

                $aisle->save();

                $column->number = $request->column;
                $column->aisleID = $aisle->id;

                $column->save();

                $row->number = $request->row;
                $row->columnID = $column->id;

                $row->save();

                return ['section' => $section, 'aisle' => $aisle, 'column' => $column, 'row' => $row];
            }
        }
        else {
            $section = new Section();
            $aisle = new Aisle();
            $column = new Column();
            $row = new Row();

            $section->code = $request->section;
            $section->warehouseID = $request->warehouseID;

            $section->save();

            $aisle->number = $request->aisle;
            $aisle->sectionID = $section->id;

            $aisle->save();

            $column->number = $request->column;
            $column->aisleID = $aisle->id;

            $column->save();

            $row->number = $request->row;
            $row->columnID = $column->id;

            $row->save();

            return ['section' => $section, 'aisle' => $aisle, 'column' => $column, 'row' => $row];
        }

    }

    public function getSections(Warehouse $warehouse){
        $section = Section::where('warehouseID', $warehouse->id)->get();
        return $section;
    }

    public function getAisles(Section $section){
        $aisle = Aisle::where('sectionID', $section->id)->get();
        return $aisle;
    }

    public function getColumns(Aisle $aisle){
        $column = Column::where('aisleID', $aisle->id)->get();
        return $column;
    }

    public function getRows(Column $column){
        $row = Row::where('columnID', $column->id)->get();
        return $row;
    }

    public function getItems(Row $row) {
        $items = ProductLocation::with("product_warehouse.product")->where('rowID', $row->id)->get();
        $return = [];
        foreach ($items as $key => $item) {
            array_push($return, [
                'name' => $item->product_warehouse->product->name,
                'price' => $item->product_warehouse->product->price,
                'stock' => $item->stock
            ]);
        }
        return $return;
    }

    public function storeItemToLocation(Request $request){
        $product_warehouse = ProductWarehouse::find($request->product_warehouseID);
        $product_location = ProductLocation::where('product_warehouseID', $request->product_warehouseID)->where('rowID', $request->rowID)->first();

        if($product_location){
            $product_location->stock = $product_location->stock + $request->stock;
        }
        else {
            $product_location = new ProductLocation();

            $product_location->product_warehouseID = $request->product_warehouseID;
            $product_location->rowID = $request->rowID;
            $product_location->stock = $request->stock;
        }


        $unassigned = $product_warehouse->unassigned - $request->stock;
        if($unassigned < 0) {
            $unassigned = 0;
        }

        $product_warehouse->unassigned = $product_warehouse->unassigned - $request->stock;
        $product_warehouse->assigned = $product_warehouse->assigned + $request->stock;

        $product_warehouse->save();
        $product_location->save();

        return [$product_warehouse, $product_location];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $row = Row::find($request->rowID);
        $row->delete();
        return $row;
    }
}
