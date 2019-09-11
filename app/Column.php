<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 'columns';

    public function aisle() {
        return $this->belongsTo('App\Aisle', 'aisleID');
    }
}
