<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ratings;
use App\Review;
use App\ratingoptions;
use App\Speaker;

class RatingsController extends Controller
{
   
   /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //id of the review
    {
		return Review::findOrFail($id)->ratings()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($input,$review_id)
    {
        for ($i=1;$i<=5;$i++){
    		$rating = new Ratings;
    		$rating->review_id=$review_id;
    		$rating->ratingoption_id=$i;
    		$rating->score=$input[$i];
    		$rating->save();
    	}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($input)
    {
    	$ratings=Ratings::where('review_id',$input['review_id']);
    	for($i=1;$i<=5;$i++){
    		$ratings ->where('ratingoption_id',$i)
          			 ->update(['score' => $input[$i]]);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO
    }
    
    public static function getRatings($id){
		$ratings = Review::findOrFail($id)->ratings()->get();
		return $ratings;
    }
}
