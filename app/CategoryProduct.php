<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'categoryproducts';

    public function categories() {
        return $this->hasMany('App\Category');
    }

    public function products() {
        return $this->hasMany('App\Products');
    }
}
