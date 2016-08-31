
<div class="col-md-12" id="reviews">
	<?php $i=0; ?>
	@foreach ($reviews as $review)
		@if(($review->quote)!='' && ($review->quote)!=null)

	<div class="row review-container">
		<div class="col-md-3 col-sm-2 hidden-xs review-picture">
			<!-- photo of the user -->
			@if($page==='speaker')
			<a href={{url('user').'/'.$users[$i]->id}}>
			<img class="img-responsive img-circle review-photo"
				src= "https://s3-ap-northeast-1.amazonaws.com/talk-advisor/users/{{$users[$i]->profile_picture}}"
				alt="user">
			</a>
			@else
			<a href={{url('speaker').'/'.$speakers["$i"]->id}}>
			<img class="img-responsive img-circle review-photo"
			src="https://s3-ap-northeast-1.amazonaws.com/talk-advisor/speakers/{{$speakers[$i]->speaker_photo}}"
				alt="{{$speakers[$i]->speaker_name}}">
			</a>
			
			@endif
		</div>
		<div class="col-sm-6 review-text">
			<span class="review-quote">
			
			@if ($page==='speaker')
			<h4 class="media-heading">Quote of {{$users["$i"]->name}}</h4>
			@endif
			<span class="quotes">
				<span id=<?php echo "text$i"?>>"{{$review->quote}}"</span>
			</span>
			</span> 
			<span class="review-date">
				{{$review->created_at->diffForHumans()}} 
			</span>
			<!-- Display the edit button if the review if from the connected user -->
			<div class="col-md-3 col-md-offset-4">
			@if ($page=='user')
				@if ($user->id == $connectedUser)
					<button class="btn btn-perso btn-edit" data-toggle="modal" data-target="#modalEdit" data-rating=<?php echo $i ?>>Edit review</button>
				@endif
			@else @if ($users[$i]->id == $connectedUser)
				<button class="btn btn-perso btn-edit" data-toggle="modal" data-target="#modalEdit" data-rating=<?php echo $i ?>>Edit review</button>
				@endif
			@endif 
			</div>
		</div>
		<div class="col-sm-3 stars-review" data-rating=<?php echo $i ?>>
			<?php   $j=0; ?>
		</div>
	</div>					
	<?php $i++; ?>
		@endif
	@endforeach
</div>

<!-- If we are not in the homepage, we use infinite scroll so pagination -->
@if ($page != 'home')
	<div class="hidden"> {!! $reviews->render() !!} </div>
@endif

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
					{!! Form::open(array('id'=>'editForm')) !!}
						@foreach ($options as $option)nt
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
odal-footer">
				<span class="review-date"></span>
			</div>
		</div>
	</div>
</div>
<!-- End of the modal -->
