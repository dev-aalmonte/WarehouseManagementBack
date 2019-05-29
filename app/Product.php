<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function warehouse() {
        return $this->belongsTo('App\Warehouse');
    }

    public function orderDetails() {
        return $this->belongsToMany('App\Order', 'orderdetails', 'productID', 'orderID');
    }

    public function categoryProducts() {
        return $this->belongsToMany('App\Category', 'categoryproducts', 'productID', 'categoryID');
    }
}
