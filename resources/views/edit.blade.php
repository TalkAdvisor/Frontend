@extends('template') @section('title') {{$user->name}} - Profile @stop

@section ('header') {{Html::style('css/user.css')}} @stop

@section('content')

<div class="container-fluid">
	<div class="margin">
		<div class="margin">
			<div class="col-md-3">
				<div class="picture"></div>
			</div>
			<div class="col-md-6 col-md-offset-1">
			{{Form::open(array('class'=>'form-horizontal','id'=>'formEdit'))}}
				<div class="form-group">
				{{Form::label('name','Username')}}
				{{Form::text('name',$user->name, array('id'=>'name', 'class' => 'form-control'))}}
				</div>
				<div class="form-group">
				{{Form::label('email','Email')}}
				{{Form::email('email',$user->email, array('id'=>'email','class' => 'form-control'))}}
				</div>
				<div class="form-group">
				{{Form::label('old_password','Old Password')}}
				{{Form::password('old_password', array('class' => 'form-control'))}}
				</div>
				<div class="form-group">
				{{Form::label('password','New Password')}}
				{{Form::password('password', array('class' => 'form-control'))}}
				</div>
				<div class="form-group">
				{{Form::label('password_confirmation','Password Confirmation')}}
				{{Form::password('password_confirmation', array('class' => 'form-control'))}}
				</div>
				<div class="form-group">
				{{Form::submit('Subit changes', array('class' => 'form-control'))}}
				</div>
				
			{{Form::close()}}
			</div>
		</div>
	</div>
</div>



@stop @section('script')
		
<script>
var user={!!json_encode($user)!!};

$(function(){
    $(document).on('submit', '#formEdit', function(e) {  
        e.preventDefault();
        $('input+small').text('');
        $('input').parent().removeClass('has-error');
        var name = $("#name").val();
        var email = $("#email").val();
       /* var password = $("#password").val(); */
         
        $.ajax({
        	headers:{"Authorization":sessionStorage['token']},
            method: 'POST',
            url: "http://52.69.148.135/ws/api/user/"+connectedUser,
            data: { name : name, email : email },
            dataType: "json",
        })
        .done(function(data) {
            window.location=url+"/user/"+data.user.id;
        })
        .fail(function(data) {
           
        });
    });
    
})


</script>
	
@stop