<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    protected $table = 'product_warehouses';

    public function product() {
        return $this->belongsTo('App\Product', 'productID');
    }

    public function warehouse() {
        return $this->belongsTo('App\Warehouse', 'warehouseID');
    }

    public function status() {
        return $this->belongsTo('App\Status', 'id');
    }
}
