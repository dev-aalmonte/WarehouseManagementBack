<?php

namespace App\Http\Controllers\API;

use App\ProductWarehouse;
use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductWarehouse  $productWarehouse
     * @return \Illuminate\Http\Response
     */
    public function show(ProductWarehouse $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductWarehouse  $productWarehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductWarehouse $stock)
    {
        $stock->statusID = $request['statusID'];
        $stock->stock = $request['stock'];

        $stock->save();

        return $stock;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductWarehouse  $productWarehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductWarehouse $stock)
    {
        $stock->delete();
        return $stock;
    }
}
