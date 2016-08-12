/* This script has to be used everytime we call the partial "showReviews".
 * This initialises the stars and the read more.
 * Therefore it need commentReviews and ratings to be passed to the view.
 */


$('.comment').readmore({
	blockCSS: 'display: inline-block'
});

$(document).ready(function(){

var text =null;
	for(i=0;i<reviews['data'].length;i++){
	text = $('.text'+i).text().replace("\n","<br>");
 	$(".text"+i).html(text);	
	}	

$( ".stars-review" ).hover(function() {
		$(this).find('.btn-grades-stars').removeClass('hidden');
		$(this).find('.btn-grades').addClass('hidden');
	}, function() {
		$(this).find('.btn-grades-stars').addClass('hidden');
		$(this).find('.btn-grades').removeClass('hidden');
	});	

//setting un the good value for each star in the comment
	for(i=0;i<reviews['data'].length;i++){
		$("#overallStar"+i).val(ratings[i][0].score)
		for(j=0;j<6;j++){
			if (typeof ratings[i][j]!= 'undefined'){
				$("#grade"+i+j).val(ratings[i][j].score);
			}	
		}
	}
	
//initialise the stars showing the overall grade in the beggining of the comment
	$('.kv-ltr-theme-svg-star-xs').rating({
	  	min: 0, max: 5, step: 0.5, stars: 5,
	    theme: 'krajee-svg',
	    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
	    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
	  	displayOnly:true,
	    size:'xs'
	  });
	
	$('.kv-ltr-theme-svg-star-sm').rating({
	  	min: 0, max: 5, step: 0.5, stars: 5,
	    theme: 'krajee-svg',
	    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
	    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
	  	displayOnly:true,
	    size:'sm'
	  });
	
//setting un the good value for each star in the comment
	for(i=0;i<reviews['data'].length;i++){
		$("#overallStar"+i).val(ratings[i][0].score)
	}
	
	//initialise the stars showing the overall grade in the beggining of the comment
	$('.kv-ltr-theme-svg-star-overall').rating({
	  	min: 0, max: 5, step: 0.5, stars: 5,
	    theme: 'krajee-svg',
	    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
	    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
	  	displayOnly:true,
	    size:'xs'
	  });
	
//Script to fill the content of the modal "Edit" 
	$('#modalEdit').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 					// Button that triggered the modal
		  var id = button.data('rating') 						// Extract info from data-* attributes
		  // Update the modal's content.
		  var modal = $(this)
		  modal.find('.modal-title').text('Edit your review')
		  modal.find('.review-date').text(reviews['data'][id].created_at)
		  for(i=1;i<6;i++){
			  	modal.find('#edit'+i).val(ratings[id][i-1].score);
			  	modal.find('#'+i).val(ratings[id][i-1].score);
			  	modal.find('#comment').val(reviews['data'][id].comment);
			  	modal.find('#quote').val(reviews['data'][id].quote);
			  	modal.find("#review_id").val(reviews['data'][id].id);
			  	if(page=='user'){
			  		modal.find("#editForm").attr('action',url+'/user/'+user.id);			  		
			  	} else {
			  		modal.find("#editForm").attr('action',url+'/user/'+users[id].id);			  		
			  	}
			  }
		  
		//initialise the stars used to update
		    $('.kv-ltr-theme-svg-star').rating({
		    	min: 0, max: 5, step: 0.5, stars: 5,
		        theme: 'krajee-svg',
		        filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
		        emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
		        showClear: false,
		        showCaption: false,
		        size:'xl'
		    });	
		    
		   // Updates the value of the fields "grades" of the form when stars are clicked
			$("#edit1").rating().on("rating.change", function(event, value, caption) {  
				$("#1").val(value); 
			}); 
		
		    $("#edit2").rating().on("rating.change", function(event, value, caption) {   
		 	   $("#2").val(value); 
		     }); 
		
		    $("#edit3").rating().on("rating.change", function(event, value, caption) { 
		       $("#3").val(value); 
		     }); 
		
		    $("#edit4").rating().on("rating.change", function(event, value, caption) {  
		 	   $("#4").val(value); 
		     }); 
		
		    $("#edit5").rating().on("rating.change", function(event, value, caption) {  
		 	   $("#5").val(value); 
		     });

	})
	
	
});