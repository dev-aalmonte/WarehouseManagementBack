<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLocation extends Model
{
    protected $table = 'product_locations';

    public function product_warehouse() {
        return $this->belongsTo('App\ProductWarehouse', 'product_warehouseID');
    }

    public function row() {
        return $this->belongsTo('App\Row', 'rowID');
    }
}
