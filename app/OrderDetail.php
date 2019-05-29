<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}
