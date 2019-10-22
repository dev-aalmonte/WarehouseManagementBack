<?php

namespace App\Http\Controllers\API;

use App\ProductWarehouse;
use App\Warehouse;
use App\ProductLocation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class StockController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;
        $warehouse = $request->warehouse;
        if(isset($request->search)) {
            return ProductWarehouse::with('product')
                    ->with('warehouse')
                    ->with('status')
                    ->whereHas('product', function (Builder $query) use ($search) {
                        $query->where('name', 'like','%'.$search.'%');
                    })
                    ->where('warehouseID',  $warehouse)
                    ->paginate(15);
        }

        return ProductWarehouse::with('product')
                    ->with('warehouse')
                    ->with('status')
                    ->where('warehouseID', $warehouse)
                    ->paginate(15);
    }

    public function store(Request $request)
    {
        $product_warehouse = ProductWarehouse::where('productID', $request['productID'])->where('warehouseID', $request['warehouseID'])->first();
        if($product_warehouse) {
            $product_warehouse->stock = $request['stock'] + $product_warehouse->stock;
        }
        else {
            $product_warehouse = new ProductWarehouse();

            $product_warehouse->productID = $request['productID'];
            $product_warehouse->warehouseID = $request['warehouseID'];
            $product_warehouse->statusID = $request['statusID'];
            $product_warehouse->stock = $request['stock'];
            $product_warehouse->unassigned = $request['stock'];
        }

        $product_warehouse->save();

        return $product_warehouse;
    }

    public function show(ProductWarehouse $stock)
    {
        //
    }

    public function update(Request $request, ProductWarehouse $stock)
    {
        $stock->statusID = $request['statusID'];
        $stock->stock = $request['stock'];

        $stock->save();

        return $stock;
    }

    public function destroy(ProductWarehouse $stock)
    {
        $stock->delete();
        return $stock;
    }

    public function getLocations(ProductWarehouse $stock) {
        $locations = ProductLocation::with("row.column.aisle.section")->where('product_warehouseID', $stock->id)->get();
        $return = [];
        foreach ($locations as $key => $location) {
            array_push($return, [
                'location' => "{$location->row->column->aisle->section->code}-{$location->row->column->aisle->number}-{$location->row->column->number}-{$location->row->number}",
                'stock' => $location->stock
            ]);
        }
        return $return;
    }
}
