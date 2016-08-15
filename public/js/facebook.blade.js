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
    //call for the facebook API to get emial and name
    FB.api('/me', 'get', {fields: 'email,first_name,last_name'}, function(response){
    var facebook_email = response.email;
    var facebook_id = response.id;
    var facebook_name = response.first_name+" "+response.last_name;
    //call for our API to now if the user already as an account
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
          //the user has an account so we just log him in.
          login(data.user.id);
        }
        else if (data.status=="2"){
          //the user has an account but not linked to facebook so we update the user to add its facebook_id to its profile
          addFacebookId(data.user.id,facebook_id);
          //and we log him in.
          login(data.user.id);
        }
        else if (data.status=="3"){
          //we fill the fields of the form with the informations of Facebook.
            $('#nameFB').val(facebook_name);
            $('#emailFB').val(facebook_email);
            $('#facebook_id').val(facebook_id);
            //we open the new modal with the form.
            $('#login').modal('hide');
            switchModal('register','register-fb');
            //then we get the profile picture of the user.
            getFacebookPicture(facebook_id); 
        }
      }) 
    //fail of socialLogin call
    .fail(function(data) {
        $.each(data.responseJSON, function (key, value) {
              var input = '#formRegister input[name=' + key + ']';
              $(input + '+small').text(value);
              $(input).parent().addClass('has-error');
            });
      }) 
    });
  };
      //we then user validate the info of facebook registration
          $(function(){
            $(document).on('submit', '#formRegisterFB', function(e) {  
                e.preventDefault();
                $('input+small').text('');
                $('input').parent().removeClass('has-error');
                var id = $("#id").val();
                var name = $("#nameFB").val();
                var email = $("#emailFB").val();
                var password = $("#input-passwordFB").val();
                var image = $('#input-profile-picFB').val();
                var phone_number = $('#input-phoneFB').val();
                var facebook_id = $('#facebook_id').val();
                 
                $.ajax({
                    headers:{"Authorization":sessionStorage['token']},
                    method: 'POST',
                    url: "http://52.69.148.135/ws/api/user/register",
                    data: { name : name , email : email , password : password, phone_number : phone_number, facebook_id : facebook_id}, 
                    dataType: "json",
                })
                .done(function(data) {
                  var id = data.user.id
                  login(id);
                  console.log('registered');
                  $('#register-fb').modal('hide');
                  // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
                  $('#picture').cropper({
                    aspectRatio: 1 / 1,
                    crop: function(e) {
                      var canevas = $('#picture').cropper('getCroppedCanvas');
                      var context = canevas.getContext("2d");
                      var img = new Image();
                      img.onload = function() {
                          context.drawImage(img, 0, 0);
                      };
                      img.src = $('#picture').attr('src');
                      console.log(context); 
                      console.log(canevas);    
                      canevas.toBlob(function (blob) {
                        console.log(blob);
                        var formData = new FormData();
                        formData.append('user-'+id, blob);
                        $.ajax('http://52.69.148.135/ws/api/user/'+id, {
                          headers:{"Authorization":sessionStorage['token']},
                          method: "POST",
                          data: formData,
                          processData: false,
                          contentType: false,
                          success: function () {
                            console.log('Upload success');
                          },
                          error: function () {
                            console.log('Upload error');
                          }
                        });
                      });
                    }
                  });
                  
                 });
              })
            })

        function addFacebookId(user_id,facebook_id){
          $.ajax({
            headers:{"Authorization":sessionStorage['token']}, 
            method: 'POST',
            url: "http://52.69.148.135/ws/api/user/"+user_id,
            data: {facebook_id:facebook_id},
            dataType:"json", 
          })
          .done(function(data) {
              //
            })
          .fail(function(data){
              //
            })
        }

        function getFacebookPicture(facebook_id){
          var facebook_image = null;
          FB.api( "/"+facebook_id+"/picture", 
                    {"height":"200","width":"200","redirect":"false",},
            function (response) {
              facebook_image = response.data.url;
              //console.log(response.data);
              //console.log(response.error);
              if (response && !response.error) {
                $('#picture').attr('src',facebook_image);
              }                    
          });
        }
