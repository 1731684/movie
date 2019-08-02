<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieList extends Model
{
    public function Theatre(){
        return $this->hasOne('App\Theater','id','theater_id');
    }
    public function City(){
        return $this->hasOne('App\cityList','id','city_id');
    }
}
