<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';

    public function users() {
        return $this->hasMany('App\User');
    }

    public function addresses() {
        return $this->belongsTo('App\Address');
    }

    public function products() {
        return $this->hasMany('App\Product');
    }
}
