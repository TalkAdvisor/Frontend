@extends('template')

@section ('title') TalkAdvisor @stop
<!-- Main Content -->
@section('content')
<div class="container-fluid">
    <div class="margin row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    <p> Enter the email address associated with your account. We will send you a link via email to reset your password. </p>
                    {{ Form::open(array('url'=>'/password/email','class'=>'form-horizontal','id'=>'formEmail')) }}
                        <div class="form-group">
                        {{Form::label('email','E-Mail Address',array('class'=>'col-md-4 control-label'))}}

                            <div class="col-md-6">
                            {{Form::email('email',old('email'),array('class'=>'form-control'))}}
                            </div>
                        </div>
                        <div class="alert alert-success alert-important hidden">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                An email has been sent to your email adress to reset your password. 
                        </div>
                        <div class="alert alert-danger alert-important hidden">
                            <button type="button" class="close" data-dismiss="alert"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                                There is not account associated with this email adress in our database.</br>
                                If you don't have an account yet, please <a data-dismiss="modal" data-toggle="modal" data-target="#register">register</a> or sign in with Facebook.
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
