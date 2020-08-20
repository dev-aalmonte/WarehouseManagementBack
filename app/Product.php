<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function image() {
        return $this->hasMany('App\ProductImages', 'productID');
    }

    public function warehouse() {
        return $this->belongsToMany('App\Warehouse', 'product_warehouses', 'productID', 'warehouseID');
    }

    public function orderDetails() {
        return $this->belongsToMany('App\Order', 'orderdetails', 'productID', 'orderID');
    }

    public function categoryProducts() {
        return $this->belongsToMany('App\Category', 'categoryproducts', 'productID', 'categoryID');
    }
}
