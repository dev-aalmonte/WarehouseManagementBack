<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $with = ['billingAddress', 'shippingAddress'];

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function billingAddress() {
        return $this->belongsTo('App\Address', 'billing_addressID', 'id');
    }

    public function shippingAddress() {
        return $this->belongsTo('App\Address', 'shipping_addressID', 'id' );
    }
}
