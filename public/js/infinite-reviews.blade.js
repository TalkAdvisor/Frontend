var page=1;
 $('#reviews').infinitescroll({
	 navSelector  : "ul.pagination",            
	                // selector for the paged navigation (it will be hidden)
	 nextSelector : "ul.pagination li a",    
	                // selector for the NEXT link (to page 2)
	 itemSelector : "#reviews div.review-container"  ,        
	                // selector for all items you'll retrieve
 	loading: { finishedMsg: "No more reviews to load.", 
 	 		   msgText: "<em>Loading older comments</em>", 
 	 		behavior:'twitter'
},
 	animate      : true,
 	bufferPx     : 0,
 	extraScrollPx: 50,      

},function(arrayOfNewElems){
	//We execute read more on the new reviews
	$.each(arrayOfNewElems,function(){
		selector = $(this).find('.more');
		readmore(120, selector) ;
	});
	//We set the good number on the buttons that call the modals.
	var i=0;
	$(this).find('.btn-grades').each(function(){
			$(this).attr('data-rating',i++);
		});
	//We do the same for the stars that needs to have the good id
	var j=0;
	$(this).find('.kv-ltr-theme-svg-star-overall').each(function(){
		$(this).attr('id',"overallStar"+j++);
	});
	getComments(speaker.id,++page);;
}); 

// Get all the data used to display the new reviews and initialise the stars.
function getComments(id,page) {
     $.ajax({
         url : id+'/reviews?page='+page,
         dataType: 'json',
     }).done(function (data) {
         	reviews['data'] = reviews['data'].concat(data.reviews['data']);
         	ratings = ratings.concat(data.ratings);	
         	users = users.concat(data.users);	

         	//setting un the good value for each star in the comment
        	for(i=0;i<ratings.length;i++){
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
     }).fail(function () {
         alert('Ratings could not be loaded.');
     });
 }
 