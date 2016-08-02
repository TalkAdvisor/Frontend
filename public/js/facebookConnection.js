//Initialisation
window.fbAsyncInit = function() {
    FB.init({
      appId      : '219968235071143',
      xfbml      : true,
      version    : 'v2.7',
      session : {!! json_encode(Session::all()) !!},    
      status  : true,    
      cookie  : true,  
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

  FB.Event.subscribe('auth.login', function() {    
      window.location.reload();    
    });    
  };    

  (function() {    
    var e = document.createElement('script');    
    e.src = document.location.protocol + '//connect.facebook.net/fr_FR/all.js';    
    e.async = true;    
    document.getElementById('fb-root').appendChild(e);    
  }());    
      //your fb login function    
      function fblogin() {    
 FB.login(function(response) {    
          //...    
        }, {perms:'read_stream,publish_stream,offline_access'});    
redir();    
      }    
  