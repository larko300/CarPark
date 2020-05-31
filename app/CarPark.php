<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarPark extends Model
{
    protected $guarded = [];

    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
