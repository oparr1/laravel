@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col8">
            <section id="loginForm">
					@if (count($errors) > 0)
						<div class="message error">
							Failed to login. Check to see if you entered your details correctly.
						</div>
					@endif

					 <h3>Sign in with your email address</h3>
					 <hr />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="contacttooltips">
							<label class="col-md-4 control-label">Email Address</label>
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						<?php 
                            if ($errors->first('email') == true) {
                                echo '<label class="error">', $errors->first('email'), '</label>';
                            }
                        ?> 
						</div>
						</div>

						<div class="form-group">
							<div class="contacttooltips">
							<label class="col-md-4 control-label">Password</label>
							<input type="password" class="form-control" name="password">
						<?php 
                            if ($errors->first('password') == true) {
                                echo '<label class="error">', $errors->first('password'), '</label>';
                            }
                        ?> 
						</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>
							</br>
								<p>Forgotten your password? Follow the link to <a class="btn btn-link" href="{{ url('/password/email') }}">recover your password </a></p>
							</div>
						</div>
					</form>
            </section>
        </div>
    </div>
</div>



@endsection
