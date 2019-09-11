<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aisle extends Model
{
    protected $table = 'aisles';

    public function section() {
        return $this->belongsTo('App\Section', 'sectionID');
    }
}
