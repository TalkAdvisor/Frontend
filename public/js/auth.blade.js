/* Function called when we close a modal to open another.
 * It allows the modal to scroll.
 */

    function switchModal(modalClose,modalOpen){
        $('#'+modalClose).modal('hide');
        $('#'+modalOpen).modal('show');        
        setTimeout(function() {
        // needs to be in a timeout because we wait for BG to leave
        // keep class modal-open to body so users can scroll
        $('body').addClass('modal-open');
    }, 400); 
    } 

// for the login
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
            if(data.message=="success"){
               $('#login').modal('hide');
               login(data.user.id);
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

//for the email sending
$(function(){

    $(document).on('submit', '#formEmail', function(e) {  
        e.preventDefault();
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        var email = $("#email").val();
       
        $.ajax({
            headers:{"Authorization":sessionStorage['token']}, 
            method: $(this).attr('method'),
            url: "http://52.69.148.135/ws/api/??",
            data: {email : email},
            dataType:"json", 
        })
        .done(function(data) {
            console.log(data);
            if(data.message=="success"){
                $('#login').modal('hide');
                $(".alert-success").removeClass('hidden');
            }
            else {
                $(".form-group").addClass('has-error');
                $(".alert-danger").removeClass('hidden');
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

//for the password reseting
$(function(){

    $(document).on('submit', '#formPassword', function(e) {  
        e.preventDefault();
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        var password = $("#password").val();

        $.ajax({
            headers:{"Authorization":sessionStorage['token']}, 
            method: $(this).attr('method'),
            url: "http://52.69.148.135/ws/api/??",
            data: {password : password},
            dataType:"json", 
        })
        .done(function(data) {
            console.log(data);
            if(data.message=="success"){
                $('#login').modal('hide');
                $(".alert-success").removeClass('hidden');
            }
            else {
                $(".form-group").addClass('has-error');
                $(".alert-danger").removeClass('hidden');
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

//for the registration and registration page
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
                    login(data.user.id);
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

        // Script for the custom file upload (it only deals with the look of the button)
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
            
function login(id){
    $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
    method: 'POST',
    url: 'login/'+id,
    data: {id : id},
    dataType:"json", 
})
    .done(function(data) {
        //console.log(data);
        window.location=url;  
    })
    .fail(function(data){
        //console.log('fail');
        //console.log(data);
    })   
}

function convertFromURL(url){
    var dataURI = url;
    // convert base64 to raw binary data held in a string
    // doesn't handle URLEncoded DataURIs - see SO answer #6850276 for code that does this
    // convert base64/URLEncoded data component to raw binary data held in a string
    var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);

    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to a typed array
    var ia = new Uint8Array(byteString.length);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    return new Blob([ia], {type:mimeString});
}