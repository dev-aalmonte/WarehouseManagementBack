<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function products() {
        return $this->hasMany('App\Product');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function orderUsers() {
        return $this->hasMany('App\OrderUser');
    }
}
