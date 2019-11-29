<?php

namespace App\Http\Controllers;
use Illuminate\http\Request;
use App\Answer;
use App\Forum;
use App\User;
use Illuminate\Support\Facades\Hash;



class AnswersController extends Controller
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


    public function giveAnswer(Request $request) {

    	$api_token = $request->api_token;
    	$id = $request->id;

 		$user= User::where('api_token', $api_token)->first();
    	$id= Forum::where('id', $id)->first();


    	 if(!$user) {
        	return response()->json(['message' => 
        		"You are not logged in", 401]);	
        }


    	$answer = Answer::create([
            
            'id_question'=> $id->id,
            'text'=> $request->text,

            
        ]);    

		return response()->json(['status' => 'success', 'message' => 'You have successfully answered to the question', 'answer' => $answer], 200);
    }


        
}