$(document).on('ready', function(){

//quote container
	var j=0;  //the jth quote is displayed, this is important to know if there is still a quote to show when we go back
	$("#text-quote").text('" '+quotes[0]+' "');
	if(quotes.length==1){
		$("#quote-right").addClass('hidden');
	}
	
	// Access to the next quote						
    $("#quote-right").click(function(){    
        j++
    	console.log(j);
    	console.log(quotes[j]);
    	console.log(quotes[j+1]);
    	$("#text-quote").text('" '+quotes[j]+' "');
		if (j==1){						// there is now one quote that we can go back to
			$("#quote-left").removeClass('hidden');
        }
        if(j==quotes.length-1){
            $("#quote-right").addClass('hidden');
        }
    });
    
	// Acces to the previous quote
    $("#quote-left").click(function(){
        j--
    	$("#text-quote").text('" '+quotes[j]+' "');
    	if (j==0){						// there is no quote "on the left"
			$("#quote-left").addClass('hidden');
        }
    	if(j==quotes.length-2){			//there is now a quote we can go to
            $("#quote-right").removeClass('hidden');
        }
    });
    
});