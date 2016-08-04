<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Speaker;
use Session;
use App\Http\Controllers\Auth\AuthController;

class FormController extends Controller
{
	public function post(Request $request, $type1){
		if ($type1=='search'){
			$controller = new PagesController;
			$name=$request->all()['speaker_name'];
			if($name==""){
				\Session::flash('search_error',"Please, try to type the name of a speaker");
				return redirect('/' );
			}
			else {
				$speaker=Speaker::where('speaker_name',$name)->first();
				if ($speaker===null) { 		
					\Session::flash('search_error',"Sorry the speaker $name has not been created yet");
					return redirect('/' );
				}
				return redirect("speaker/$speaker->id");
			}
		}
		else if ($type1=='login'){
			$controller= new AuthController();
			return $controller->login($request);
		}
		else if($type1=='register'){
			$controller= new AuthController();
			return $controller->register($request);
		}
		else {
			redirect("/");
		}
	}
	
	public function post2(Request $request, $type1,$type2){
		if ($type1=='speaker'){
			if (array_key_exists('1', $request->all())){
				$controller=new ReviewController();
				$controller->store($request,$type2);

				\Session::flash ( 'flash_message', 'Your review has been posted succesfully' );
				$pagesController = new PagesController ();
				return $pagesController->getPage2 ( 'speaker', $type2 );
			}
			else {
				$controller=new SpeakerController;
				$controller->postVideo($request,$type2);
				\Session::flash('flash_message', 'Your video has been posted succesfully');    	
		    	$pagesController = new PagesController;
		    	return $pagesController->getPage2('speaker',$type2);

			}
		}
		if($type1=='user'){
			if (array_key_exists('email', $request->all())){		//if there if an email it is an update of the user
				$userController = new UserController();
				$userController->update($request,$type2);
				return redirect("/");
			}
			else {													//else this is an update of a review
				$reviewController = new ReviewController();
				$reviewController->update($request,$type2);
				return redirect("/$type1/$type2");
			}
		}
	}
}