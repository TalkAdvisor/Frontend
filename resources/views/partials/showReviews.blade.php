
<div class="col-md-12" id="reviews">
	<?php $i=0; ?>
	@foreach ($reviews as $review)

	<div class="row review-container">
		<div class="col-sm-3 hidden-xs review-picture">
			<!-- photo of the user -->
			@if($page==='home')
			<div class="row flex">
				<div class="col-md-6 col-xs-6 no-padding">
					<a href={{url('user').'/'.$users[$i]->id}}>
					<img class="img-responsive img-circle"
						src=https://lh6.googleusercontent.com/-St077kPaI3A/AAAAAAAAAAI/AAAAAAAAAE4/nshp34I8yjM/photo.jpg
						alt="user">
					</a>
				</div>
				<div class="col-md-6 col-xs-6 no-padding">
					<a href={{url('speaker').'/'.$speakers["$i"]->id}}>
					<img class="img-responsive img-circle" style="margin-left:-10px;"
					src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$speakers[$i]->speaker_photo}}"
						alt="{{$speakers[$i]->speaker_name}}">
					</a>
					<img src={{url('img/sticker_speaker.png')}} class="sticker-speaker">
				</div>
			</div>
			@else @if($page==='speaker')
			<a href={{url('user').'/'.$users[$i]->id}}>
			<img class="img-responsive img-circle" style="width:80%"
				src=https://lh6.googleusercontent.com/-St077kPaI3A/AAAAAAAAAAI/AAAAAAAAAE4/nshp34I8yjM/photo.jpg
				alt="user">
			</a>
			@else
			<a href={{url('speaker').'/'.$speakers["$i"]->id}}>
			<img class="img-responsive img-circle" style="width:80%"
			src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$speakers[$i]->speaker_photo}}"
				alt="{{$speakers[$i]->speaker_name}}">
			</a>
			@endif
			@endif
		</div>
		<div class="col-sm-6 review-text">
			<span class="review-comment">
			@if ($page==='home')
			<h4 class="media-heading">Comment of {{$users["$i"]->name}} on {{$speakers["$i"]->speaker_name}}</h4>
			@else @if ($page==='speaker')
			<h4 class="media-heading">Comment of {{$users["$i"]->name}}</h4>
			@else
			<h4 class="media-heading">Comment on {{$speakers["$i"]->speaker_name}}</h4>
			@endif
			@endif
			
				<input id=<?php echo "overallStar$i"?> 
						class="kv-ltr-theme-svg-star-xs rating-loading" value="2"> 
				<span class="more" id=<?php echo "$i"?> >{{$review->comment}}</span>
			</span> 
			<span class="review-date">
				{{$review->created_at->diffForHumans()}} 
			</span>
		</div>
		<div class="col-sm-3 stars-review">
			<?php   $j=0; ?>
			<button class="btn btn-default btn-grades hidden" data-toggle="modal"
				data-target="#modalRating" data-rating=<?php echo $i ?>>See grades</button>
				<div class="btn-grades-stars">
					@foreach ($options as $option)
					<div class="row">
						<div class="col-md-6 col-sm-6 stars-small">
							<h5 data-container="body" data-toggle="tooltip" data-placement="left" title="{{$option->description}}">{{$option->name}}</h5>
						</div>
						<div class="col-md-6 col-sm-6 stars-small">
							<input id="grade{{$i}}{{$j}}"
							class="kv-ltr-theme-svg-star-sm rating-loading " value="2">
						</div>
					</div>
					<?php  $j++; ?>	
					@endforeach
				</div>
		</div>
		<!--  <div class="col-sm-3 review-button">
			<button class="btn btn-default btn-grades" id="btn-grades" data-toggle="modal"
				data-target="#modalRating" data-rating=<?php echo $i ?>>See grades</button>
			@if($page=='user' && $connectedUser)
			<button class="btn btn-perso btn-edit" data-toggle="modal"
				data-target="#modalEdit" data-rating=<?php echo $i ?>>Edit review</button>
			@endif
		</div> -->
	</div>					
	<?php $i++; ?>
	@endforeach
</div>

<!-- If we are not in the homepage, we use infinite scroll so pagination -->
@if ($page != 'home')
	<div class="hidden"> {!! $reviews->render() !!} </div>
@endif

<!-- Modal for the ratings of each comment -->
<div class="modal fade" id="modalRating" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel2">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2"></h4>
			</div>
			<div class="modal-body">
						<?php   $j=1; ?>
						@foreach ($options as $option)
						<div class="row">
					<div class="col-lg-6 center-text-small">
						<span class="small-text">{{$option->name}}</span>
					</div>
					<div class="col-lg-3 center-text-small">
						<input id="stars{{$j}}"
							class="kv-ltr-theme-svg-star-comment rating-loading " value="2">
					</div>
						<?php  $j++; ?>	
						</div>
				@endforeach
			</div>
			<div class="modal-footer">
				<span class="review-date"></span>
			</div>
		</div>
	</div>
</div>
<!-- End of the modal -->

<!-- Modal to edit each comment -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel2">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel2">Edit</h4>
			</div>
			<div class="modal-body">
				<div id="stars-edit">
					<div class="row">
					{!! Form::open(); !!}
						@foreach ($options as $option)
							<div class="col-lg-6 star-container {{$option->id===5 ? 'col-lg-offset-3' : ''}}">
								<div class="in-line">
									<p>{{$option->name}}</p>
									<span class="glyphicon glyphicon-info-sign info2" data-container="body" data-toggle="tooltip" data-placement="right" title="{{$option->description}}"></span>
								</div>
								<input id="edit{{$option->id}}" class="kv-ltr-theme-svg-star rating-loading " value="2">
								<!-- Only contains the grade but is never showed -->
								{!! Form::number( $option->id ,2,array('id'=> $option->id, 'class'=>'hidden', 'step'=>'any')); !!}
							</div>
						@endforeach
					</div>
				</div>
				<div class="row" id="text-fields-edit">
					<div class="col-lg-10 col-lg-offset-1 form-group">
					{!! Form::number('review_id',null, array('id'=>'review_id','class'=>'hidden'))!!}
					{!! Form::label('comment', 'Your comment :') !!} 
					{!!Form::textarea('comment', null , array('class' => 'form-control',
						'placeholder'=>'一個好的評論，應該能夠讓人做為是否參加同一個講者未來的演講的參考。因此這個評論應該著重於同一個講者不同場演講的共通點。首要的評分關鍵是講者能夠選取適合觀眾、演講長度、公告的主題的題材的能力。更為重要的是講者在傳達時，是否有能力以清晰、有啟發性且吸引人的方式表達。如果你還是不太知道該如何撰寫你的評論，可以嘗試先以文字敘述你以上填寫評分的原因。'));
						!!}</div>
					<div class="col-lg-10 col-lg-offset-1 form-group">{!!
						Form::label('quote', 'Your quote from the speech :') !!} {!!
						Form::text('quote', null , array('class' => 'form-control')); !!}
					</div>
					<div class="col-lg-10 col-lg-offset-1 form-group">
					{!! Form::submit('Submit changes',array('class' => 'btn btn-perso')); !!}
					</div>
					{!!Form::close(); !!}
				</div>
			</div>
			<div class="modal-footer">
				<span class="review-date"></span>
			</div>
		</div>
	</div>
</div>
<!-- End of the modal -->
