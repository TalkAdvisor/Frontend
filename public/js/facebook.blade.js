function statusChangeCallback(response) {
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      connectUser();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
      FB.login(function(response){
        connectUser();
      },{scope:'public_profile,email'});
            } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      FB.login(function(response){
        connectUser();
      },{scope:'public_profile,email'});
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '219968235071143',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function connectUser() {
    FB.api('/me', 'get', {fields: 'email,first_name,last_name'}, function(response){
    var facebook_email = response.email;
    var facebook_id = response.id;
    var facebook_name = response.first_name+" "+response.last_name;
    $.ajax({
      headers:{"Authorization":sessionStorage['token']}, 
      method: 'POST',
      url: "http://52.69.148.135/ws/api/user/socialLogin",
      data: {email : response.email, fb_id : response.id },
      dataType:"json", 
    }) 
    .done(function(data) {
      console.log(data);
        if(data.status=="1"){
          //we just log the user in.
          window.location="login/"+data.user.id;
        }
        else if (data.status=="2"){
          //we update the user to add its facebook_id to its profile
          $.ajax({
            headers:{"Authorization":sessionStorage['token']}, 
            method: 'POST',
            url: "http://52.69.148.135/ws/api/user/"+data.user.id,
            data: {name:data.user.name, image:data.user.image, phone_number:data.user.phone_number,facebook_id:facebook_id},
            dataType:"json", 
          })
          .done(function(data) {
              
            })
          .fail(function(data){
              //
            })
        }
        else if (data.status=="3"){
        //we have to register the user with its facebook info.
        //first we get it's profile picture
        var facebook_image = null;
          FB.api(
              "/10210889799820076/picture", 
              {
                "height":"200",
                 "width":"200",
                 "redirect":"0",
               },
              function (response) {
                facebook_image = response.data.url;
                //console.log(response.data);
                //console.log(response.error);
                if (response && !response.error) {
        //then we ask him to check the infos and to validate
                $('#login').modal('hide');
                switchModal('register','register-fb');
                $('#nameFB').val(facebook_name);
                $('#emailFB').val(facebook_email);
                $('#facebook_id').val(facebook_id);
                $('#facebook_image').attr('src',facebook_image);
                //we convert the url image to image :
                $('#input-profile-picFB').val(facebook_image);
                 }
              }
          );   
        }
      }) 
    //fail of socialLogin call
    .fail(function(data) {
        //
      }) 
    });
  };
      //we then user validate the info of facebook registration
          $(function(){
            $(document).on('submit', '#formRegisterFB', function(e) {  
                e.preventDefault();
                $('input+small').text('');
                $('input').parent().removeClass('has-error');
                var name = $("#nameFB").val();
                console.log('name');
                var email = $("#emailFB").val();
                var password = $("#input-passwordFB").val();
                var image = $('#input-profile-picFB').val();
                var facebook_id = $('#facebook_id').val();
                var phone_number = $('#input-phoneFB').val();
                 
                $.ajax({
                    headers:{"Authorization":sessionStorage['token']},
                    method: 'POST',
                    url: "http://52.69.148.135/ws/api/user/register",
                    data: { name : name , email : email , password : password, image : image, phone_number : phone_number, facebook_id : facebook_id },
                    dataType: "json",
                })
                .done(function(data) {
                    $('#register-fb').modal('hide');
                    window.location=url+"/register/"+data.user.id;
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