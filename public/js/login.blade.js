$(function(){

    $(document).on('submit', '#formLogin', function(e) {  
        e.preventDefault();
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        var email = $("#email").val();
        var password = $("#password").val();

       
        $.ajax({
        	headers:{"Authorization":sessionStorage['token']}, 
            method: $(this).attr('method'),
            url: "http://52.69.148.135/ws/api/user/login",
            data: {email : email, password : password },
            dataType:"json", 
        })
        .done(function(data) {
            console.log(data);
            if(data.message=="success"){
                $('#login').modal('hide');
                window.location="login/"+data.user.id;
            }
            else {
            	$(".form-group").addClass('has-error');
            	$(".alert").removeClass('hidden');
            }
            	
            })
        .fail(function(data) {
            $.each(data.responseJSON, function (key, value) {
                var input = '#formLogin input[name=' + key + ']';
                $(input + '+small').text(value);
                $(input).parent().addClass('has-error');
            });
        });
    });
    
})