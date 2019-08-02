<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cityList;
use App\MovieList;

class MovieController extends Controller
{
    public function index(){
        // return "Hello";
        $cities=cityList::all();
        $movies=MovieList::with('Theatre')->take(12)->get();
        // return $movies;
        return view('home',['cities'=>$cities,'movies'=>$movies]);
    }
    public function filterMovie(Request $request){
        $theater_id=$request->input('theatre_id');
        $movies=MovieList::select()->where('theater_id',$theater_id)->get();
        return $movies;
    }
    public function updateMovie(Request $request){
        $movieId=$request->input('movieId');
        $movieName=$request->input('movieName');
        $dateFrom=$request->input('dateFrom');
        $dateTo=$request->input('dateTo');
        $language=$request->input('language');
        
        $movie=MovieList::find($movieId);
        $movie->movie_name=$movieName;
        $movie->date_from=$dateFrom;
        $movie->date_to=$dateTo;
        $movie->language=$language;
        if($movie->save()){
            $res=[
                'status'=>'200',
                'msg'=>'Successfully Booked'
            ];
            return response()->json($res, 200);
        }else{
            $res=[
                'status'=>'400',
                'msg'=>'Failed to Book'
            ];
            return response()->json($res, 400);
        }
        
    }
    public function deleteMovie(Request $request){
        $movieId=$request->input('movieId');
        
        $movie=MovieList::find($movieId);
        
        if($movie->delete()){
            $res=[
                'status'=>'200',
                'msg'=>'Successfully deleted'
            ];
            return response()->json($res, 200);
        }else{
            $res=[
                'status'=>'400',
                'msg'=>'Failed to delete'
            ];
            return response()->json($res, 400);
        }
        
    }
}
