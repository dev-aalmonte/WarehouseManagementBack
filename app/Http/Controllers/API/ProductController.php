<?php

namespace App\Http\Controllers\API;

use App\Product;

use App\Http\Requests\StoreProductPost;

use Illuminate\Support\Facades\Storage;
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
        $item_number = isset($request->item_number) ? $request->item_number : 15;
        if(isset($request->search)){
            return Product::where('name', 'like', '%'.$search.'%')->paginate($item_number);
        }
        return Product::paginate($item_number);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPost $request)
    {
        $validated = $request->validated();
        
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
        
        $product->save();
        
        return ($validated) ? $product : $validated;
    }
    
    public function uploadImage(Request $request, Product $product) {
        if($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = "{$product->name}";
            $request->file('image')->storeAs("Products/{$product->name}", "{$filename}[{$request->index}].{$extension}");
        }

        return $request;
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

        return $product;
    }
}
