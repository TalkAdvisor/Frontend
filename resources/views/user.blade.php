@extends('template') @section('title') {{$user->name}} - Profile @stop

@section ('header') {{Html::style('css/user.css')}} @stop

@section('content')

@if ($stats['number_ratings']===0)
			<div class="alert alert-perso alert-info alert-success alert-important">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				{{$connectedUser ? 'You have not posted a review yet, time to get to work !' : 'This user has not posted a review yet' }}
			</div>
		@endif
<div class="container-fluid">
	<div class="margin">
		<div class="row bloc user-bloc">
			<div class="col-md-4 col-sm-6">
						<h4 class="user-title">
						@unless($connectedUser)
							Who is {{$user->name}} ?
						@else
							What do people know about you ?
						@endunless
						</h4>
						<div class="first user-credit">
							<i class="fa fa-users fa-margin" aria-hidden="true"></i>
							<p class="inline-block">Became a member {{$user->created_at->diffForHumans()}}</p>			
						</div>
						<div class="user-credit">
							<i class="fa fa-check fa-margin" aria-hidden="true"></i>
							<p class="inline-block">Verified user</p>
						</div>
						<div class="user-credit">
							<i class="fa fa-pencil-square-o fa-margin" aria-hidden="true"></i>
							<p class="inline-block">Wrote {{$stats['number_comments']}} comments</p>
						</div>
						<div class="user-credit">
							<i class="fa fa-star fa-margin" aria-hidden="true"></i>
							<p class="inline-block">Gave {{$stats['number_ratings']}} ratings</p>
						</div>
						<div class="user-credit">
							<i class="fa fa-comment fa-margin" aria-hidden="true"></i>
							<p class="inline-block">Quoted {{$stats['number_quotes']}} speakers</p>
						</div>

			</div>
			<div class="col-md-4 col-sm-6 center">
				<div class="col-md-8 col-md-offset-2">
					<img class="img-circle img-responsive"
						src=" https://s3-ap-northeast-1.amazonaws.com/talk-advisor/users/{{$user->profile_picture}}">
					<h1>{{$user->name}}</h1>
					@if($connectedUser)
					<a class="btn btn-perso" href="{{$user->id}}/edit">Edit my profile</a>
					@endif
				</div>

			</div>
			<div class="col-md-4 col-sm-12">
				<h4 class="user-title">
				@unless($connectedUser)
					How does {{$user->name}} rates ?
				@else
					How do you rate ?
				@endunless
				</h4>
				<div class="user-ratings">
				<?php   $i=1; ?>
				@foreach ($options as $option)
				<div class="row">
						<div class="col-md-4 col-sm-4" style="width: 90px;">
							<h5>{{$option->name}}</h5>
						</div>
						<div class="col-md-2 col-sm-2">
							<span class="fa fa-info-circle fa-lg info" data-container="body"
								data-toggle="tooltip" data-placement="right"
								title="{{$option->description}}"></span>
						</div>
						<div class="col-md-6 col-sm-6">
							<input id="option{{$i}}"
								class="{{$user->number_reviews===null ? 'kv-ltr-theme-svg-star-disabled' : 'kv-ltr-theme-svg-star-display'}} rating-loading "
								value="2">
						</div>
					</div>
				<?php  $i++; ?>			
				@endforeach
				</div>
			</div>
		</div>
		<div style="margin-top:20px;">
			  <!-- Nav tabs -->
			  <center>
			  	<b>
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active" style="width:50%;"><a style="border-radius:0px;margin-left:-15px;" href="#home" aria-controls="home" role="tab" data-toggle="tab">Reviews</a></li>
				    <li role="presentation" style="width:50%;
				    "><a style="border-radius:0px;margin-right:-15px;" href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Quotes</a></li>
				  </ul>
				</b>
			  </center>
			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="home">
				    <div class="row bloc review-tab">
				    	@include('partials.showReviews')
				    </div>
			    </div>
			    <div role="tabpanel" class="tab-pane" id="profile">
				    <div class="row bloc review-tab">
						@include('partials.showQuotes')
					</div>
			    </div>
			  </div>

			</div>
	</div>

	@stop @section('script')
		
	<script>

	var reviews = {!!json_encode($reviews)!!};
	var ratings= {!! json_encode($ratings) !!};
	var stats = {!! json_encode($stats) !!};
	var user = {!! json_encode($user)!!};
		
//setting up the good value for the stars on the main page
	for($i=0;$i<=5;$i++){
    	$("#option"+$i).val( stats['average_'+$i] );
	}

    //initialise the stars of the main page
    $('.kv-ltr-theme-svg-star-display').rating({
    	min: 0, max: 5, step: 0.5, stars: 5,
        theme: 'krajee-svg',
        filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
        emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
        displayOnly:true,
        size:'lg'
    });

	//initialise the disabled stars (when there is no reviews yet)
    $('.kv-ltr-theme-svg-star-disabled').rating({
	    theme: 'krajee-svg',
	    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
	    emptyStar: '<span class="krajee-icon krajee-icon-star disabled-stars"></span>',
	  	displayOnly:true,
	    size:'lg'
	  });

</script>
	
		{{Html::script('js/showReviews.js')}}
	
	@stop