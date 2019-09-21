<?php

namespace App\Http\Controllers\API;

use App\Warehouse;
use App\Section;
use App\Aisle;
use App\Column;
use App\Row;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        if(isset($request->search)) {
            return Warehouse::with('section.aisle.column.row')
                    ->whereHas('product', function (Builder $query) use ($search) {
                        $query->where('name', 'like','%'.$search.'%');
                    })
                    ->where('id',  $warehouseID)
                    ->paginate(15);
        }

        return Warehouse::with('section.aisle.column.row')
                    ->where('id', $warehouseID)
                    ->paginate(15);
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
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
