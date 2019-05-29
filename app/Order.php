<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function client() {
       return $this->belongsTo('App\Client');
    }

    public function orderUsers() {
        return $this->belongsToMany('App\User', 'orderusers', 'orderID', 'userID');
    }

    public function orderDetails() {
        return $this->belongsToMany('App\Product', 'orderdetails', 'orderID', 'productID');
    }
}
