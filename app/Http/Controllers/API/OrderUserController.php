<?php

namespace App\Http\Controllers\API;

use App\OrderUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderUser = new OrderUser();

        $orderUser->orderID = $request->orderID;
        $orderUser->userID = $request->userID;
        $orderUser->statusID = 2;

        $orderUser->save();

        return $orderUser;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderUser  $orderUser
     * @return \Illuminate\Http\Response
     */
    public function show(OrderUser $orderUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderUser  $orderUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderUser $orderUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderUser  $orderUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderUser $orderUser)
    {
        //
    }
}
