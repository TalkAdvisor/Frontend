<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Requests;
use App\Speaker;
use App\User;
use Session;
use App\Http\Controllers\Auth\AuthController;

class FormController extends Controller
{

	public function post1(Request $request, $type1){
		if ($type1=='search'){
			$controller = new PagesController;
			$name=$request->all()['speaker_name'];
			if($name==""){
				Session::flash('search_error',"Please, type the name of a speaker");
				return redirect('/' );
			}
			else {
				$speaker=Speaker::where('speaker_name',$name)->first();
				if ($speaker===null) { 		
					Session::flash('search_error',"Sorry the speaker $name has not been created yet");
					return redirect('/' );
				}
				return redirect("speaker/$speaker->id");
			}
		}
		else {
			redirect("/");
		}
	}
	
	public function post2(Request $request, $type1,$type2){
		if ($type1=='speaker'){
			if (array_key_exists('1', $request->all())){
				$reviewController=new ReviewController();
				$reviewController->store($request,$type2);
				Session::flash ( 'flash_message', 'Your review has been posted succesfully' );
			}
			else {
				$controller=new SpeakerController;
				$controller->postVideo($request,$type2);
				Session::flash('flash_message', 'Your video has been posted succesfully');    	
			}
		return redirect("speaker/$type2");
		}
		if($type1=='user'){
			if (array_key_exists('email', $request->all())){		
			//if there if an email it is an update of the user
				$userController = new UserController();
				$userController->update($request,$type2);
				return redirect("/");
			}
			else {													
			//else this is an update of a review
				$reviewController = new ReviewController();
				$reviewController->update($request,$type2);
				return redirect(URL::previous());
			}
		}
		if ($type1=='login'){
			Session::put('user',$type2);
			Session::put('flash_message','You are now loggued in');
			return json_encode($type2);
		}
	}
}