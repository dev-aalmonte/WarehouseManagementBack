<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function billingAddress() {
        return $this->belongsTo('App\Address');
    }

    public function shippingAddress() {
        return $this->belongsTo('App\Address');
    }
}
