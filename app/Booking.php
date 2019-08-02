<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function Movie(){
        return $this->hasOne('App\MovieList','id','movie_id');
    }
}
