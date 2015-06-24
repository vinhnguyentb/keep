@extends('layouts.app')
@section('meta-description', 'Keep - Recover user password')
@section('title', 'Password Recovery')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary form-wrapper">
                <div class="panel-heading"><strong>Forgot your password?</strong></div>
                <div class="panel-body">
                    {!! Form::open() !!}
                        <div class="form-group">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control input-lg', 'placeholder' => 'username@example.com']) !!}
                            {!! error_text($errors, 'email') !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-lg btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer form-link">
                    Trying to <a href="{{ route('auth::login') }}"> Login</a><br>
                    Don't have an account? <a href="{{ route('auth::register') }}"> Create a free account</a>
                </div>
            </div>
		</div>
	</div>
@stop
