<?php

namespace App\Http\Controllers\API;

use App\Warehouse;
use App\Address;

use App\Http\Requests\StoreWarehousePost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if(isset($request->search)) {
            return Warehouse::with('address')->where('name', 'like', '%'.$search.'%')->paginate(15);
        }
        return Warehouse::with('address')->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehousePost $request)
    {

        $validated = $request->validated();

        $warehouse = new Warehouse();
        $address = new Address();

        $address->street_address = $request->street_address;
        $address->extra_address = $request->extra_address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;

        $address->save();

        $warehouse->name = $request->name;
        $warehouse->addressID = $address->id;

        $warehouse->save();

        return $validated;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return Warehouse::with('address')->find($warehouse->id);
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
        $address = Address::find($warehouse->addressID);

        $address->street_address = $request->street_address;
        $address->extra_address = $request->extra_address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;

        $address->save();

        $warehouse->name = $request->name;

        $warehouse->save();

        return $warehouse;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        $address = Address::find($warehouse->addressID);
        $warehouse->delete();
        $address->delete();

        return 1;
    }
}
