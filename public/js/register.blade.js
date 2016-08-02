$( document ).ready(function(){
	
	$("#btn-email").click(function(){
		$("#btn-facebook").hide();
		$("#btn-email").hide();
	
		$("#formRegister").show();
		
	});

});

$(function(){

    $(document).on('submit', '#formRegister', function(e) {  
        e.preventDefault();
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        var name = $("#name").val();
        var email = $("#emailTrue").val();
        var password = $("#password").val();
        console.log(email);
         
        $.ajax({
        	headers:{"Authorization":sessionStorage['token']},
            method: $(this).attr('method'),
            url: "http://52.69.148.135/ws/api/user/register",
            data: { name : name , email : email , password : password },
            dataType: "json",
        })
        .done(function(data) {
            $('#register').modal('hide');
            window.location="register/"+data.user.id;
        })
        .fail(function(data) {
            $.each(data.responseJSON, function (key, value) {
                var input = '#formRegister input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');
            });
        });
    });
    
})

// Script for the custom file upload (it only deals with its look)
$(function() {

	  // We can attach the `fileselect` event to all file inputs on the page
	  $(document).on('change', ':file', function() {
	    var input = $(this),
	        numFiles = input.get(0).files ? input.get(0).files.length : 1,
	        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	  });

	  // We can watch for our custom `fileselect` event like this
	  $(document).ready( function() {
	      $(':file').on('fileselect', function(event, numFiles, label) {

	          var input = $(this).parents('.input-group').find(':text'),
	              log = numFiles > 1 ? numFiles + ' files selected' : label;

	          if( input.length ) {
	              input.val(log);
	          } else {
	              if( log ) alert(log);
	          }

	      });
	  });
	  
	});

$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
	
	
