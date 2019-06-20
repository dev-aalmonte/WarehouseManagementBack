<?php

namespace App\Http\Controllers\API;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($search !== '' || $search !== null){
            return Product::where('name', 'like', '%'.$search.'%')->paginate(15);
        }

        return Product::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->metric_weight = $request->metric_weight;
        $product->weight = $request->weight;
        $product->metric_longitude = $request->metric_longitude;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->length = $request->length;
        $product->warehouseID = $request->warehouseID;
        $product->statusID = $request->statusID;

        $product->save();

        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->metric_weight = $request->metric_weight;
        $product->weight = $request->weight;
        $product->metric_longitude = $request->metric_longitude;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->length = $request->length;
        $product->warehouseID = $request->warehouseID;
        $product->statusID = $request->statusID;

        $product->save();

        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return 1;
    }
}
