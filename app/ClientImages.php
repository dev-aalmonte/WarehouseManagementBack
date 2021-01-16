<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientImages extends Model
{
    protected $table = 'client_images';

    public function product() {
        return $this->belongsTo('App\Client', 'clientID');
    }
}
