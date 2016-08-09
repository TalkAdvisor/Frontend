
@if ($page=='home')

<nav class="navbar navbar-home navbar-fixed-top" id="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand no-padding" href="{{url('/')}}">
				<img class="img-brand" src="{{url('img/icon.png')}}" alt="talkadvisor">
			</a>
			<a class="navbar-brand" href="{{url('/')}}">
				TalkAdvisor
			</a>
		</div>

		<div class="collapse navbar-collapse navbar-right"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if (\Session::has('user'))
				<li><a href="{{url('user').'/'.Session::get('user')}}">Profile</a></li>
				<li><a href="{{ url('logout') }}" id="logout">Logout</a></li>
				@else
				<li><a data-toggle="modal" data-target="#login">Login</a></li>
				<li><a data-toggle="modal" data-target="#register">Register</a></li>
				@endif

			</ul>
		</div>

	</div>
</nav>
       
@else

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"
				data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<a class="navbar-brand no-padding" href="{{url('/')}}">
				<img class="img-brand" src="{{url('img/icon.png')}}" alt="talkadvisor">
			</a>
			<a class="navbar-brand" href="{{url('/')}}">TalkAdvisor</a>
		</div>

		<div class="collapse navbar-collapse"
			id="bs-example-navbar-collapse-1">
			<div class="collapse navbar-collapse navbar-right"
			id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if (\Session::has('user'))
				<li><a href="{{url('user').'/'.Session::get('user')}}">Profile</a></li>
				<li><a href={{ url('logout') }} id="logout">Logout</a></li>
				@else
				<li><a data-toggle="modal" data-target="#login">Login</a></li>
				<li><a data-toggle="modal" data-target="#register">Register</a></li>
				@endif
				<!--  	<form class="navbar-form" role="search">
						<div class="form-group" id="the-basics">
							<input type="text" class="form-control-perso typeahead"
								placeholder="Search for a speaker">
						</div>
						<button type="submit" class="button-perso"
							style="border: 0; background: transparent">
							<img src="http://localhost/laravel5/public/images/loupe.png"
								width="25" height="25" alt="submit" />
						</button>
					</form> -->
				</li>
			</ul>
		</div>
			

		</div>

	</div>
</nav>

@endif