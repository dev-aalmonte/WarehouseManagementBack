<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    protected $table = 'rows';

    public function column() {
        return $this->belongsTo('App\Column', 'columnID');
    }

    public function product_warehouse() {
        return $this->belongsToMany('App\ProductWarehouse', 'product_locations', 'rowID', 'product_warehouseID');
    }
}
