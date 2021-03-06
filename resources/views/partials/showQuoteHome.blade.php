<?php $i=0; ?>
@foreach($quotes as $quote)
<div class="row">
	<div class="col-md-12 quote-home">
	@if ($i%2==0)
		<div class="col-md-2 col-sm-2 hidden-xs" id="speaker{{$i}}">
			<div class="review-picture">
				<!-- photo of the speaker -->
				<a  href="{{url('speaker').'/'.$quote['speaker_id']}}">
				<img class="img-responsive img-circle"
				src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$quote['photo']}}"
				alt="speaker"></a>
			</div>
		</div>
		<div class="col-md-8 col-sm-10 col-xs-12">
			<div class="bubble center">
				<p class="quote">" {{$quote['quote']}} "</p></br>
				 <a href="{{url('speaker').'/'.$quote['speaker_id']}}">
				 	{{$quote['name']}}
				 </a>
			</div>
		</div>
	@else
		<div class="col-md-8 col-sm-10 col-xs-12 col-md-offset-2">
			<div class="bubble-left center">
				<p class="quote">" {{$quote['quote']}} "</p></br>
				<a href="{{url('speaker').'/'.$quote['speaker_id']}}">
					{{$quote['name']}}
				</a>
			</div>
		</div>
		<div class="col-md-2 col-sm-2 hidden-xs" id="speaker{{$i}}">
			<div class="review-picture">
				<!-- photo of the speaker -->
				<a  href="{{url('speaker').'/'.$quote['speaker_id']}}">
				<img class="img-responsive img-circle"
					src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$quote['photo']}}" alt="speaker"></a>
			</div>
		</div>
	@endif
	</div>
</div>
<?php $i++; ?>
@endforeach