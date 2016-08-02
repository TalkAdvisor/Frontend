<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connect</title> 

 {{ Html::style('css/plugins/bootstrap/bootstrap.min.css') }}
 {{ Html::style('css/navbar.css') }}
 {{ Html::style('css/style.css') }} 
 {{ Html::style('css/plugins/star-rating.css') }} 
 {{ Html::style('css/plugins/theme-krajee-svg.css') }}
 {{ Html::style('css/login-register.css')}}
 {{ Html::style('css/plugins/bootstrap-social.css')}}
 {{ Html::style('css/plugins/font-awesome.min.css')}}
 {{ Html::style('css/button.css')}}
 
  
 </head>

<body>

	
</body>

	<a class="btn btn-primary" id="connect" href="/laravel5/public/user/1">Connect</a>

 	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	{{ Html::script('js/plugins/bootstrap.min.js') }} 
	<script>
	$("#connect").click(function(){
		{{ Session::put('user','1') }}
		{{ Session::flash('flash_message','Ariane is now connected') }}
	});
	</script>

</body>
</html>