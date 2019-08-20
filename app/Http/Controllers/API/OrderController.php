<?php

namespace App\Http\Controllers\API;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($search !== '' || $search !== null) {
            return Order::with('status')->with('orderDetail')->with('orderDetails')->where('clientID', $request->clientID)->paginate(15);
        }
        return Order::with('status')->with('orderDetail')->with('orderDetails')->where('clientID', $request->clientID)->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();

        $order->clientID = $request->clientID;
        $order->subtotal = $request->subtotal;
        $order->tax = $request->tax;
        $order->shipping = $request->shipping;
        $order->total = $request->total;
        $order->statusID = 6;

        $order->save();

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return Order::with('status')->with('orderDetail')->with('orderDetails')->find($order->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->clientID = $request->clientID;
        $order->subtotal = $request->subtotal;
        $order->total = $request->total;
        $order->statusID = $request->statusID;

        $order->save();

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return 1;
    }
}
