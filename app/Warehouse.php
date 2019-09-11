<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    public function users() {
        return $this->hasMany('App\User');
    }

    public function address() {
        return $this->belongsTo('App\Address', 'addressID');
    }

    public function products() {
        return $this->belongsToMany('App\Product', 'product_warehouses', 'warehouseID', 'productID');
    }
}
