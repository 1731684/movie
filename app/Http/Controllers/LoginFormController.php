<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Tymon\JWTAuth\JWTAuth;
// use Tymon\JWTAuth\Facades\JWTAuth;
use App\MovieList;
use App\Booking;

class LoginFormController extends Controller
{
    public function __construct()
    {
        // $this->middleware('jwt.auth', []);
    }
    public function index(){
        return view('login');
    }
    public function dashboard(){
        // return $token;
        $user = Auth::guard()->user();
        return view('dashboard',['user'=>$user]);
        return $user;
    }
    public function dashboardBooking(){
        $user = Auth::guard()->user();
        $bookings=Booking::with('Movie')->get();
        // return $bookings;
        return view('dashboardBookings',['user'=>$user,"bookings"=>$bookings]);
        // return $user;
    }
    public function dashboardMovies(){
        $user = Auth::guard()->user();
        $Movies=MovieList::with('Theatre')->get();
        // return $bookings;
        return view('dashboardMovies',['user'=>$user,"Movies"=>$Movies]);
        // return $user;
    }
    public function dashboardMoviesEdit(Request $request){
        $user = Auth::guard()->user();
        $movieId=$request->input('id');
        $movieInfo=MovieList::with('Theatre')->with('City')->where('id',$movieId)->get();
        // return $movieInfo;
        return view('dashboardMoviesEdit',['user'=>$user,"movieInfo"=>$movieInfo]);
        // return $user;
    }
    
    
}
