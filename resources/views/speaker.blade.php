@extends('template') @section('title') {{$speaker->speaker_name}} -
TalkAdvisor @stop @section('content')

		@if ($speaker->number_reviews===null)
			<div class="alert alert-perso alert-info alert-success alert-important">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				This speaker has no review yet. Be the first to grade him or her!
			</div>
		@endif

<div class="container-fluid">
	<div class="margin">
		<div class="row firstBloc">
			<div class="col-md-4">
				<h1 class="center ">{{$speaker->speaker_name}}</h1>
				<h4 class="center">{{$speaker->speaker_englishname}}</h4>
				<div class="star-container star-container-margin">
					<input id="overall-notation" name="overall-notation"
						class="{{$speaker->number_reviews===null ? 'kv-ltr-theme-svg-star-disabled' : 'kv-ltr-theme-svg-star-display'}} rating-loading"
						value="{{$speaker->average_1}}">
				
					<!-- Button to pop the modal. See at the end for the modal -->
					@if(Session::has('user'))
					<button type="button" class="btn btn-default btn-margin"
						data-toggle="modal" data-target="#myModal">Rate this speaker</button>
					@else
					<button type="button" class="btn btn-default btn-margin"
						data-toggle="modal" data-target="#register">Rate this speaker</button>
					@endif
				</div>
			</div>

			<div class="col-md-2 col-md-offset-1 col-sm-4 col-xs-4 img-container">
				<img class="img-circle img-responsive"
					src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$speaker->speaker_photo}}">
			</div>

			<div class="col-md-4 col-md-offset-1">
				@if (isset($speaker->speaker_title) && isset($speaker->speaker_company))
				<div class="company center"><h3>{{$speaker->speaker_company}} {{$speaker->speaker_title}}</h3></div>
				@endif
				<div class="presentation">
					<span class="more" >{{$speaker->speaker_description}}</span>
				</div>
				@unless ($speaker->description_source===null)					
				<p class="source">来源 : {{$speaker->description_source}}</p>
				@endunless
			</div>
		</div>

		@unless ($quotes->isEmpty())
			@include('partials.showQuote')
		@endunless
		
		<div class="row secondBloc">
			
			@unless ($speaker->video===null)
			<div class="col-md-6 col-sm-6 col-xs-12 blocVideo">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe width="560" height="315" src="{{$speaker->video}}"
						allowfullscreen></iframe>
				</div>
			</div>
			@else
			<div class="col-md-6 col-sm-6 bloc">
				<div class="video-form-container">
				{{ Form::open() }}    			
					<div class="col-lg-10">               
	    				{{ Form::label('video','Upload a video of this speaker !',array('class'=>'video-label'))}} 
	    			</div>
					<div class="col-lg-10">               
	    				{{ Form::text('video',null,array('class'=>'form-control','placeholder'=>'Example : https://www.youtube.com/watch?v=HUmX6CiMoFk'))}}  
	    			</div>
	    			<div class="col-lg-2">
	    				{{ Form::submit('Upload', array('class'=>'btn btn-primary')) }}
	    			</div>
				{{ Form::close() }}	
				</div>
			</div>
			@endunless

			<div class="col-md-6 col-sm-12 bloc ratings-bloc">
			<?php   $i=1; ?>
				@foreach ($options as $option)
				<div class="col-md-2 col-sm-2 stars-speaker">
					<h5>{{$option->name}}</h5>
				</div>
				<div class="col-md-4 col-sm-4 stars-speaker">
					<span class="fa fa-info-circle fa-lg info" data-container="body" data-toggle="tooltip" data-placement="right" title="{{$option->description}}"></span>
				</div>
					<div class="col-md-6 col-sm-6 stars-speaker">
					
						<input id="option{{$i}}"
							class="{{$speaker->number_reviews===null ? 'kv-ltr-theme-svg-star-disabled' : 'kv-ltr-theme-svg-star-display'}} rating-loading " value="2">
					</div>
				<?php  $i++; ?>			
				@endforeach
				<div>on {{$speaker->number_reviews}} ratings</div>
			</div>
		</div>
		
		@unless($reviews->isEmpty())
		<div class="row bloc">
			@include('partials.showReviews')
		</div>
		@endunless
		

	</div>
</div>

<!-- Modal for the presentation -->
<div class="modal fade" id="modalPresentation" tabindex="-1"
	role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">{{$speaker->speaker_name}}</h4>
			</div>
			<div class="modal-body">{{$speaker->speaker_description}}</div>
			<div class="modal-footer"></div>
		</div>
	</div>
</div>

<!-- Modal used to rate -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			@include('partials.ratingForm');	
		</div>
	</div>
</div>
<!-- End of the modal -->

@stop @section ('script')

<script>

var reviews = {!!json_encode($reviews)!!};
var quotes = {!! json_encode($quotes)!!};
var ratings= {!! json_encode($ratings) !!};
var speaker = {!!json_encode($speaker)!!};
var users = {!!json_encode($users)!!};

$("#btn-grades").click(function(){
	console.log('Click');
	$("#stars").addClass('hidden');
	$("#text-fields").removeClass('hidden');
});

$("#show-grades").click(function(){
	$("#stars").removeClass('hidden');
	$("#text-fields").addClass('hidden');
});

</script>

{{Html::script('js/showReviews.js')}}
{{Html::script('js/infinite-reviews.blade.js')}}
{{Html::script('js/quote-carousel.js')}}
{{Html::script('js/stars-speaker.js')}}

@stop