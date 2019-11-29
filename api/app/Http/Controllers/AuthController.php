<?php

namespace App\Http\Controllers;
use Illuminate\http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request) {

        $user = User::create([
            'username'=> $request->username,
            'email'=> $request->email,
            'password'=> app('hash')->make($request->password),
            'api_token'=> str_random(50),
            'granted' => $request->granted,
            'category'=>$request->category
        ]);

        return response()->json(['status'=> 'success','user' => $user], 200);
    }


    public function login(Request $request) {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            return response()->json(['status' =>'error', 'message'=>'User Not found'], 401);
        }

        if(Hash::check($request->password, $user->password)) {
            $user->api_token=str_random(50);
            $user->save();
            return response()->json(['status' => 'success', 'user' => $user], 200);
        }

        return response()->json(['status' =>'error', 'message'=>'Invalid Credentials'], 401);
        
    }


    public function logout(Request $request) {
        $api_token = $request->api_token;

        $user= User::where('api_token', $api_token)->first();

        if(!$user) {
            return response()->json(['status' =>'error', 'message'=>'Not Logged in'], 401);
        }

        $user->api_token=null;

        $user->save();

        return response()->json(['status' => 'success', 'message' => 'You have successfully logged out'], 200);
    }




    public function listUsers(Request $request) {

            $actor = User::select('username', 'email', 'id')->get();


            return response()->json(['message'=> $actor], 200);
    }    
}
