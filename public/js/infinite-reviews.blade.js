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
    $('.comment').readmore({
        blockCSS: 'display: inline-block'
    });
	
	//We put the right id for the stars so that we can initialize them
	var j=page;
	$(this).find('.kv-ltr-theme-svg-star-xs').each(function(){
		$(this).attr('id',"overallStar5");
	});
	getComments(speaker.id,page);
    page++;
}); 

// Get all the data used to display the new reviews and initialise the stars.
function getComments(id,page) {
     $.ajax({
         url : id+'/reviews?page='+(page+1),
         dataType: 'json',
     }).done(function (data) {
        //We update the variables reviews, ratings and users
         	reviews['data'] = reviews['data'].concat(data.reviews['data']);
         	ratings = ratings.concat(data.ratings);	
         	users = users.concat(data.users);

            //We set the good data-rating on the new reviews.
            var i=0;
            $('.stars-review').each(function(){
                $(this).attr('data-rating',i++);
            });

            var j=0;
            $(".kv-ltr-theme-svg-star-xs").each(function(){
                $(this).attr('id','overallStar'+j);
                j++;
            })

        	//setting un the good value for each star in the beggining of the comment.
            console.log(reviews['data']);
            for(i=(5*page);i<reviews['data'].length;i++){
                console.log(ratings[i][0].score);
                $("#overallStar"+i).val(ratings[i][0].score);
                console.log(i);
                console.log($("#overallStar"+i).val()); 
            }
        	//initialise the stars showing the overall grade in the beggining of the comment
            $('.kv-ltr-theme-svg-star-xs').rating({
                min: 0, max: 5, step: 0.5, stars: 5,
                theme: 'krajee-svg',
                filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
                emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
                displayOnly:true,
                size:'xs'
              }).delay(5000);
            
            $( ".stars-review" ).hover(function() {
                var id = $(this).attr('data-rating');                
                //setting the good value for the stars
                for(j=0;j<5;j++){
                    if (typeof ratings[id][j]!= 'undefined'){
                        $(".grade"+j).val(ratings[id][j].score);
                    }   
                }
                //initialising them
                $('.kv-ltr-theme-svg-star-sm').rating({
                    min: 0, max: 5, step: 0.5, stars: 5,
                    theme: 'krajee-svg',
                    filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
                    emptyStar: '<span class="krajee-icon krajee-icon-star"></span>',
                    displayOnly:true,
                    size:'sm'
                });
                    $(this).find('.btn-grades-stars').removeClass('hidden');
                    $(this).find('.btn-grades').addClass('hidden');
                }, function() {
                    $(this).find('.btn-grades-stars').addClass('hidden');
                    $(this).find('.btn-grades').removeClass('hidden');
                    for(j=0;j<5;j++){
                        $(".grade"+j).rating('destroy');
                    }
                });          		
     }).fail(function () {
         alert('Ratings could not be loaded.');
     });
 }
 