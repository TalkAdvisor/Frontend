<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
	protected $table ="review_ratingoption";
	
	protected $fillable =[
	'score',
	'review_id',
	'ratingoption_id',
	];
	
	public function review(){
		return $this->belongsTo('App\Review');
	}
}
