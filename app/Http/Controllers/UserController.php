<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Speaker;
use Illuminate\Support\Facades\Session;
use App\ratingoptions;
use App\Review;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  		$ratingController = new RatingsController();
  		$userController = new UserController();
        $user = User::find($id);
        $data=[];
        $data['user'] = $user;
        $data['page'] = 'user';
        $data['options'] = ratingoptions::all();
        
        //we calculate the average grades given by the user and the number of reviews given
        $data['stats']= $userController->getStats($id);
        
        //we are getting the reviews and ratings of the commented reviews (where the comment is not null)
        $commentReviews = $this->getCommentsOf($id);
        $data['reviews'] = $commentReviews['reviews'];
        $data['ratings'] = $commentReviews['ratings'];
        
        //speakers that were commented by the user
        $data['speakers'] = $commentReviews['speakers'];
        // we need to know if it is the userpage of the connected user
        if($id==Session::get('user')){
        	$data['connectedUser'] = true;
        }
        else $data['connectedUser'] = false;
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function getCommentsOf($id) {
    	$ratingController=new RatingsController();
    
    	$reviews = User::find ($id)->reviews()->where ( 'comment', '!=', "" )->latest ( 'created_at' )->paginate(5);
    	$ratings=[];
    	$speakers=[];
    	$i=0;
    	foreach ($reviews as $review){
    		$speakers["$i"] = Speaker::find($review->speaker_id);
    		$ratings["$i"] = $ratingController->getRatings($review->id);
    		$i++;
    	}
    
    	return ['reviews'=>$reviews,'ratings'=>$ratings,'speakers'=>$speakers];
    }
    
    public function getStats($id){
    	$stats = [];
    	$reviewsCollection = Review::where('user_id',$id);
    	$reviews=$reviewsCollection->get();
    	
    	$stats['number_ratings']=$reviews->count();
    	$stats['number_comments']=$reviewsCollection->where('comment','!=',"")->count();
    	$stats['number_quotes']=$reviewsCollection->where('quote','!=',"")->count();
    	
    	for($i=0;$i<=5;$i++){										//initialisation of the averages
    		$stats["average_$i"]=0;
    	}
    	foreach($reviews as $review){								//we sum over all the ratings							
    		$ratings=RatingsController::getRatings($review->id);
    		foreach($ratings as $rating){
    			$i = $rating->ratingoption_id;
    			$stats["average_$i"]+=$rating->score;
    		}
    	}
    	for($i=0;$i<=5;$i++){										//we divide by the number of ratings
    		$stats["average_$i"]=$stats["average_$i"]/$stats['number_ratings'];
    	} 
    	
    	return $stats;
    }
 
}
