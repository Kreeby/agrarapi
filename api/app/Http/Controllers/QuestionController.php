<?php



namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\http\Request;
use App\Forum;
use App\User;



class QuestionController extends Controller {
	/**
     * Create a new controller instance.
     *
     * @return void
     */

	public function __construct()
    {
        //
    }


    public function addQuestion(Request $request) {
    	$api_token = $request->api_token;

        $user= User::where('api_token', $api_token)->first();

        
        


        if(!$user) {
        	return response()->json(['message' => 
        		"You are not logged in", 401]);	
        }

    	$question = Forum::create([
            'name'=> $request,
            'text'=> $request->text,
            'token'=> str_random(50),
            'added_by'=>$user->id,
            'added_to'=>$request->added_to,
            'category'=>$request->category
            
        ]);

        if(!$request->hasFile('image')) {
            return response()->json(['question' => $question]);
        }
        $file = $request->file('image'); 
        $path = base_path() . '/public/uploads/images/store/';
        $file->move($path, $file->getClientOriginalName());
    
       
        

        return response()->json(['question' => $question, 'file' => $file->getClientOriginalName()]);
        // return response()->json(['status'=>'success', 'question' => $question], 200);
    }


    public function selectQuestion(Request $request) {
    	$token = $request->token;

        $question= Forum::where('token', $token)->first();


        if(!$question) {
            return response()->json(['status' =>'error', 'message'=>'There is no such question'], 401);
        }

        $question->save();

        return response()->json(['status' => 'success', 'message' => 'You have successfully queried the question', 'token' => $token], 200);
    }



    public function listQuestions(Request $request) {
    	return response()->json(['questions' => Forum::all()]);
    }



    public function listByWhom(Request $request) {
    	$added_to = $request->added_to;

    	$actor = Forum::where('added_to', $added_to)->select('created_at', 'name') -> get();




    	return response()->json(['status'=> 'success', 'message' => $actor], 200);
    }
    // public function answerQuestion(Request $request) {
    // 	$token = $request->token;




   





    // }
}