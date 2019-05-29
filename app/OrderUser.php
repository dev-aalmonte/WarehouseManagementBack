<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUser extends Model
{
    protected $table = 'orderusers';

    public function users() {
        return $this->hasMany('App\User');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function status() {
        return $this->hasMany('App\Status');
    }
}
