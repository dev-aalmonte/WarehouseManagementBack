<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function categoryProducts() {
        return $this->belongsToMany('App\Product', 'categoryproducts', 'categoryID', 'productID');
    }
}
