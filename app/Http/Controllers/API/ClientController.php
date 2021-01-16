<?php

namespace App\Http\Controllers\API;

use App\Client;
use App\ClientImages;
use App\Address;

use App\Http\Requests\StoreClientPost;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Faker;
use File;

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
            return Client::with('billingAddress')->with('shippingAddress')->with('logo')->with('background')->where('first_name', 'like', '%'.$search.'%')->paginate(15);
        }
        return Client::with('billingAddress')->with('shippingAddress')->with('logo')->with('background')->paginate(15);
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

    public function uploadImage(Request $request, Client $client) {
        $logo_client_image = new ClientImages();
        $background_client_image = new ClientImages();

        $faker = Faker\Factory::create();

        if($request->hasFile('logo')) {
            $logo_client_image->extension = $request->file('logo')->getClientOriginalExtension();
            $logo_client_image->name = $faker->sha1;
            $path = $request->file('logo')->storeAs("/public/images/clients/logo/{$client->last_name}[{$client->id}]", $logo_client_image->name.".".$logo_client_image->extension);
            $logo_client_image->path = str_replace("public/", "", $path);
        }

        if($request->hasFile('background')) {
            $background_client_image->extension = $request->file('background')->getClientOriginalExtension();
            $background_client_image->name = $faker->sha1;
            $path = $request->file('background')->storeAs("/public/images/clients/background/{$client->last_name}[{$client->id}]", $background_client_image->name.".".$background_client_image->extension);
            $background_client_image->path = str_replace("public/", "", $path);
        }

        $logo_client_image->clientID = $client->id;
        $background_client_image->clientID = $client->id;

        $logo_client_image->save();
        $background_client_image->save();

        $client->logoID = $logo_client_image->id;
        $client->backgroundID = $background_client_image->id;

        $client->save();

        return [$logo_client_image, $background_client_image];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return Client::with('billingAddress')->with('shippingAddress')->with('logo')->with('background')->find($client->id);
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
