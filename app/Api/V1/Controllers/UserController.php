<?php

namespace App\Api\V1\Controllers;
require base_path().'/vendor/twilio-php-master/Twilio/autoload.php';

use Twilio\Rest\Client;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('jwt.auth', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(Auth::guard()->user());
    }
    public function studentList(){
        $StudentList=User::select()->with('Department')->where('role','student')->get();
        return $StudentList;
    }
    public function studentDetails(Request $request){
        $studentId=$request->input('studentId');
        // return $studentId;
        $StudentDetails=User::select()->where('id',$studentId)->get();
        return $StudentDetails;
    }
    public function addNewStudent(Request $request){
        // return "saa";
        $user=new User($request->all());
        $emailExist=User::select()->where('email',$request->input('email'))->get()->count();
        if($emailExist!=0){
            return response()->json(['status' => "email already exist",], 201);
        }
        $phoneExist=User::select()->where('phone',$request->input('phone'))->get()->count();
        if($phoneExist!=0){
            return response()->json(['status' => "phone already exist",], 202);
        }
        $num=rand();
        $user->verify=$num;
        if($user->save()){
            
            $msg=$this->sendMessage($request->input('name'),$num);
            return response()->json(['status' => "Successfully added",], 200);;
        }else{
            return response()->json(['status' => "Failed to create",], 400);
        }
    }

    public function updateStudent(Request $request){

        $user=User::find($request->input('userId'));
        // return $request->input('userId');
        // // $res=$user->update([
        // //     'name'=>$request->input('name'),
        // //     'address'=>$request->input('address'),
        // //     'dob'=>$request->input('dob'),
        // //     'gender'=>$request->input('gender'),
        // //     'nic'=>$request->input('nic'),
        // // ]);
        
        // // ])->where('id',$request->input('userId'));
        // User::where('id',$userId)->update([
            
        // ])
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->phone=$request->input('phone');
        $user->address=$request->input('address');
        $user->dob=$request->input('dob');
        $user->gender=$request->input('gender');
        $user->nic=$request->input('nic');
        if($user->save()){
            return response()->json(['status' => "Successfully updated",], 200);
        }else{
            return response()->json(['status' => "Profile Updation failed",], 400);
        }
    }

    public function changePassword(Request $request){
        $userId=$request->input('userId');
        
        $user=User::find($userId);
        $userPassword=User::select('password')->where('id',$userId)->get();
        
        $OldNewCheck=Hash::check($request->input('oldPassword'),$userPassword[0]->password);
        if($OldNewCheck){
            $user->password=$request->input('newPassword');
            if($user->save()){
                return response()->json(['status' => "Successfully changed",], 200);;
            }
        }else{
            return response()->json(['status' => "Check your password",], 400);;
        }

    }

    public function sendMessage($name,$code){
        $sid = 'AC86717c18cd1aef318d56b05e01811542';
        $token = '6c2ffbdcde198778d0595e1348338c90';
        $client = new Client($sid, $token);
        // return $client;
        $msg="Hi ".$name.",\nWe welcome you to our association.Your code:".$code;
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

    public function verifyUser(Request $request){
        $user=User::select('verify')->where('id',$request->input('userId'))->get();
        // return $user[0]->verify.' '.$request->input('code');
        if($user[0]->verify==$request->input('code')){
            $res=User::where('id',$request->input('userId'))->update(['verify'=>'done']);
            if($res){
                return response()->json(['status' => "Successfully verified",], 200);
            }else{
                return response()->json(['status' => "Failed",], 400);
            }
        }else{
            return response()->json(['status' => "Failed",], 400);
        }
    }
}
