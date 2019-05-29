<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public function warehouses() {
        return $this->hasOne('App\Warehouse');
    }

    public function clients() {
        return $this->hasOne('App\Client');
    }
}
