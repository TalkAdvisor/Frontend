<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title> 

 {{ Html::style('css/plugins/bootstrap/bootstrap.min.css') }}
 {{ Html::style('css/navbar.css') }}
 {{ Html::style('css/style.css') }} 
 {{ Html::style('css/plugins/star-rating.css') }} 
 {{ Html::style('css/plugins/theme-krajee-svg.css') }}
 {{ Html::style('css/login-register.css')}}
 {{ Html::style('css/plugins/bootstrap-social.css')}}
 {{ Html::style('css/plugins/font-awesome.min.css')}}
 {{ Html::style('css/plugins/croppie.css')}}
 {{ Html::style('css/button.css')}}
  
 @yield('header')
 
 </head>

<body>	

	@include('partials.navbar')
	
	@include('partials.login')	
	@include('partials.register')
	
	@yield('homePagePhoto')
		
	@unless($page=='home')
		@include('partials.flashMessage')
	@endunless
	
	@yield('content')
	
	
</body>

 	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	{{ Html::script('js/plugins/bootstrap.min.js') }} 
	{{ Html::script('js/plugins/typeahead.bundle.min.js') }}
	{{ Html::script('js/plugins/star-rating.min.js') }}
	{{ Html::script('js/plugins/croppie.min.js')}}
	{{ Html::script('js/plugins/jquery.infinitescroll.min.js')}}
	{{ Html::script('js/register.blade.js') }}
	{{ Html::script('js/login.blade.js') }}
	
	<script>
		$('div.alert').not('.alert-important').delay(2000).fadeOut(300);

		if(typeof sessionStorage['token'] =='undefined'){
			 var settings = {
		                "url": "http://52.69.148.135/ws/auth/login",
		                "type": "Post",
		                data: {
		                              email: "test@gmail.com",
		                              password: "test123"
		                          },
		                 dataType :"json",
		               success: function(data){
		                },
		                error: function(){
		                myApp.alert('La requete n\'a pas abouti');
		                }
		                };

		              // RECUPERATION DU TOKEN

		              $.ajax(settings).done(function(data){
		                  sessionStorage['token']="Bearer"+data.token;
		              });
		    
		}
		</script>
	
	@yield('script')
	
	
</body>
</html>