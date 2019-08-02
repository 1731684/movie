<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Theater;

class TheatreController extends Controller
{
    function filterTheatre(Request $request){
        $city_id=$request->input('city_id');
        $theatres=Theater::select()->where('city_id',$city_id)->get();
        return response()->json($theatres);
    }
}
