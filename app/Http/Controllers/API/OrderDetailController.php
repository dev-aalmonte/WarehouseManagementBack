<?php

namespace App\Http\Controllers\API;

use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderDetailController extends Controller
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
        $orderDetail = new OrderDetail();

        $orderDetail->orderID = $request->orderID;
        $orderDetail->productID = $request->productID;
        $orderDetail->quantity = $request->quantity;

        $orderDetail->save();

        return $orderDetail;
    }

    public function updateStatus(Request $request) {
        $orderDetail = OrderDetail::find($request->order_detail_id);

        switch ($request->type) {
            case 'pick':
                $orderDetail->picked = $request->picked;
                $orderDetail->picked_by = $request->user_id;
                break;

            case 'ship':
                $orderDetail->packed = $request->packed;
                $orderDetail->packed_by = $request->user_id;
                break;
        }

        $orderDetail->save();

        return $orderDetail;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
