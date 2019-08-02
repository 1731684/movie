<?php

namespace App\Http\Controllers;

require base_path().'/vendor/twilio-php-master/Twilio/autoload.php';
use Illuminate\Http\Request;
use App\MovieList;
use App\Booking;
use Twilio\Rest\Client;

class BookingController extends Controller
{
    public function index($MovieId){
        $MovieDetail=MovieList::select()->where('id',$MovieId)->get();
        return view('booking',['movieInfo'=>$MovieDetail]);
    }
    public function bookMovie(Request $request){
        $bookingDate=$request->input('bookingDate');
        $movie_id=$request->input('movieId');
        $numOfBooking=$request->input('numOfBooking');
        $userEmail=$request->input('userEmail');
        $userName=$request->input('userName');
        $userPhone=$request->input('userPhone');
        $verificationCode=mt_rand(100000, 999999);

        $Book=new Booking();
        $Book->user_id=$userPhone;
        $Book->date=$bookingDate;
        $Book->movie_id=$movie_id;
        $Book->username=$userName;
        $Book->num_of_bookings=$movie_id;
        $Book->verification_code=$verificationCode;
        $Book->paid=0;

        if($Book->save()){
            $this->sendMessage($verificationCode);
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
    public function sendMessage($code){
        $sid = 'AC86717c18cd1aef318d56b05e01811542';
        $token = '6c2ffbdcde198778d0595e1348338c90';
        $client = new Client($sid, $token);
        // return $client;
        $msg="Hi,\nYou have successfully booked.Your movie code:".$code;
        $client->messages->create(
            // the number you'd like to send the message to
            // '+94767027179',
            '+94770723090',
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+12024101732',
                // the body of the text message you'd like to send
                'body' => $msg
            )
        );
    }

}
