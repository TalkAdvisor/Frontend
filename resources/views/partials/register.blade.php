
<div class="modal fade" tabindex="-1" id="register" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header header-perso">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Register</h4>
			</div>
			<div class="modal-body" >
				<!-- Body of the modal -->
				<div class="container-fluid">
					<div class="col-md-6 col-md-offset-3">
						<a type="submit" id="btn-email" class="btn btn-social btn-block btn-perso">
							<span class="fa fa-envelope"></span> Sign in with an email
						</a>
						<a class="btn btn-social btn-block btn-facebook" id="btn-facebook">
		    				<span class="fa fa-facebook"></span> Sign in with Facebook
		 				</a>
					</div>
				{{ Form::open(array('url'=>'/register','class'=>'form-horizontal','style'=>'display:none','id'=>'formRegister')) }}
						<div class="form-group">
							<label for="name" class="col-md-4 control-label">Username</label>
							<div class="col-md-6">
								<input id="name" type="text" class="form-control" name="name"
									value="{{ old('name') }}">
								<small class="help-block"></small> 
							</div>
						</div>

						<div
							class="form-group" >
							<label for="email" class="col-md-4 control-label">E-Mail Address</label>

							<div class="col-md-6">
								<input id="emailTrue" type="email" class="form-control" name="email" value="{{ old('email') }}">
								<small class="help-block"></small>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input id="input-password" type="password" class="form-control"
									name="password">
								<small class="help-block"></small>
							</div>
						</div>

						<div
							class="form-group">
							<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input id="input-password-confirm" type="password"
									class="form-control" name="password_confirmation"> 
								<small class="help-block"></small>
							</div>
						</div>
						
						<div
							class="form-group">
							<label for="profile-picture" class="col-md-4 control-label">Profile picture</label>
							<div class="col-md-6">
								<div class="input-group">
									<label class="input-group-btn">
										<span class="btn btn-default">
											Browse<input id="input-profile-pic" type="file" name="profile_picture" style="display:none" multiple> 
										</span>
									</label>
							 		<input type="text" class="form-control" readonly>
								</div>
								<p class="small">Upload one from your computer...</p>
								<div class="input-group">
									<label class="input-group-btn">
										<span class="btn btn-default disabled">
											Browse<input id="input-profile-pic" type="file" name="profile-picture" style="display:none" multiple> 
										</span>
									</label>
							 		<input type="text" class="form-control" readonly>
								</div>
								<p class="small">or choose a drawing.</p>
							</div>
						</div>
						
						<div
							class="form-group">
							<label for="phone_number" class="col-md-4 control-label">Phone number</label>
							<div class="col-md-6">
								<input id="input-phone" type="tel"
									class="form-control" name="phone_number"> 
								<small class="help-block"></small>
							</div>
							<span class="fa fa-question-circle fa-2x" data-container="body" data-toggle="tooltip" data-placement="right" title="We need your phone number to authenticate your account. It will not be used for commercial purposes."></span>
						</div>
						
						<div class="form-group center">
							<div class="col-md-6 col-md-offset-4 ">
								<button type="submit" class="btn btn-block btn-social btn-perso" style="text-align:center">
								<i class="fa fa-sign-in" aria-hidden="true"></i>
									Register
								</button>
							</div>
						</div>

					</form>
				</div>
				<!-- End of the body -->
			</div>
			<div class="modal-footer footer-perso">
				<div>You are already a member of TalkAdvisor ?</div>
				<button type="button" class="btn btn-perso-reverse" data-dismiss="modal"
					data-toggle="modal" data-target="#login">Login</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

