<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\Address;

use App\Http\Requests\StoreClientPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
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
            return Client::with('billingAddress')->with('shippingAddress')->where('first_name', 'like', '%'.$search.'%')->paginate(15);
        }
        return Client::with('billingAddress')->with('shippingAddress')->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientPost $request)
    {
        $validated = $request->validated();

        $client = new Client();
        $address = new Address();

        $address->street_address = $request->street_address;
        $address->extra_address = $request->extra_address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;

        $address->save();

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->description = $request->description;
        $client->billing_addressID = $address->id;
        $client->shipping_addressID = $address->id;

        $client->save();

        return $validated;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return Client::with('billingAddress')->with('shippingAddress')->find($client->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $address = Address::find($client->billing_addressID);

        $address->street_address = $request->street_address;
        $address->extra_address = $request->extra_address;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;

        $address->save();

        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->email = $request->email;
        $client->description = $request->description;
        $client->billing_addressID = $address->id;
        $client->shipping_addressID = $address->id;

        $client->save();

        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $address = Address::find($client->billing_addressID);
        $client->delete();
        $address->delete();

        return 1;
    }
}
