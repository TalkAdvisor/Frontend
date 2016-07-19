
/* Script to use everytime we include the "showReviews" partial.
 * It contains the read_more script and the star script.
 * It need the variables commentReview and ratings.
 */

// Script for the read more plugin
$(function () {
    $(".review-comment").dotdotdot({
        after: 'a.more',
        callback: dotdotdotCallback,
        watch:'window',
    });

    $(".presentation").dotdotdot({
        after: 'a.more',
        callback: dotdotdotCallback,
        watch:'window',
    });

    function dotdotdotCallback(isTruncated, originalContent) {
        if (!isTruncated) {
            $("a", this).remove();
        }
    }
});


//Script to fill the content of the modal of "Read more" of the reviews 
$('#modalReview').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) 					// Button that triggered the modal
	  var id = button.data('review') 						// Extract info from data-* attributes
	  // Update the modal's content.
	  var modal = $(this)
	  modal.find('.modal-title').text('Review of ' + commentReviews['data'][id].user_id)
	  modal.find('.modal-body').text(commentReviews['data'][id].comment)
	  modal.find('.review-date').text(commentReviews['data'][id].created_at)
});
	
//setting un the good value for each star in the comment
	for(i=0;i<commentReviews['data'].length;i++){
		$("#overallStar"+i).val(ratings[i][0].score)
	}
	
//initialise the stars showing the overall grade in the beggining of the comment
	$('.kv-ltr-theme-svg-star-overall').rating({
	  	min: 0, max: 5, step: 0.5, stars: 5,
	    theme: 'krajee-svg',
	    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
	    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
	  	displayOnly:true,
	    size:'xxs'
	  });
	
	$( document ).ready(function() {
	
//Script to fill the content of the modal of "See grades" of the reviews 
	$('#modalRating').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) 					// Button that triggered the modal
		  var id = button.data('rating') 						// Extract info from data-* attributes
		  // Update the modal's content.
		  var modal = $(this)
		  modal.find('.modal-title').text('Grades given by ' + commentReviews['data'][id].user_id)
		  modal.find('.review-date').text(commentReviews['data'][id].created_at)

		  for(i=1;i<6;i++){
		  	modal.find('#stars'+i).val(ratings[id][i-1].score)
		  }
		  
	//initialise the stars of this modal
		  $('.kv-ltr-theme-svg-star-comment').rating({
		  	min: 0, max: 5, step: 0.5, stars: 5,
		    theme: 'krajee-svg',
		    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
		    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
		  	displayOnly:true,
		    size:'xxs'
		  });
	})

// destroys all the ratings so that they are updated when the client clicks on another "See ratings" button
	$('#modalRating').on('hide.bs.modal', function(){
		setTimeout (function(){
			for(i=1;i<6;i++){
				$('#stars'+i).rating('destroy');
			}
		},200);
	});
	
});