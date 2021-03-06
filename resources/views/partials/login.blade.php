<div class="modal fade" tabindex="-1" id="login" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header header-perso">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body">
				<!-- Body of the modal -->
				<div class="container-fluid">
				{{ Form::open(array('url'=>'/loginUser','class'=>'form-horizontal','id'=>'formLogin')) }}
						<div class="form-group">
							{{Form::label('email','E-Mail Address',array('class'=>'col-md-4 control-label'))}}
							<div class="col-md-6">
								{{Form::email('email',old('email'),array('class'=>'form-control'))}}
							</div>
						</div>

						<div class="form-group">
							{{Form::label('password','Password',array('class'=>'col-md-4 control-label'))}}
							<div class="col-md-6">
							{{Form::password('password',array('class'=>'form-control'))}}
							</div>
						</div>
						<div class="alert alert-danger alert-important hidden">
							<button type="button" class="close" data-dismiss="alert"
								aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
								There is a mistake in your email address or your password.</br>
								If you don't have an account yet, register it only takes one minute !
						</div> 
						
						<center>
						<div class="col-md-6 col-md-offset-4">
							<div class="checkbox">
								<label> <input type="checkbox" name="remember"> Remember Me
								</label>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button id="btn-login" type="submit" class="btn btn-block btn-social btn-perso" style="text-align:center">
									<span class="fa fa-btn fa-sign-in"></span>Login
								</button>
								<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
								<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
								</fb:login-button>
								<div id="status"></div>

							</div>
						</div></center>
					</form>
				</div>
				<!-- End of the body -->
			</div>
			<div class="modal-footer footer-perso">
				<div>You don't have an account ?</div>
				<button type="button" class="btn btn-perso-reverse" data-dismiss="modal"
					data-toggle="modal" data-target="#register">Register</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->



