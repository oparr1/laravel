@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col10">
        	<section id="registerbox">
					@if (count($errors) > 0)
						<div class="message error">
							Failed to submit. Check to see if you entered your input correctly.
						</div>
					@endif

					<h3>Create a new account</h3>
        			<hr />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" novalidate>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="contacttooltips">
							<label class="col-md-4 control-label">Name</label>							
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">							
						<?php 
                            if ($errors->first('name') == true) {
                                echo '<label class="error">', $errors->first('name'), '</label>';
                            }
                        ?>   
                    </div>
						</div>

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
							<label class="col-md-4 control-label">Confirm Email</label>
							<input type="email" class="form-control" name="email_confirmation">
							<?php 
                            if ($errors->first('email_confirmation') == true) {
                                echo '<label class="error">', $errors->first('email_confirmation'), '</label>';
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
							<div class="contacttooltips">
							<label class="col-md-4 control-label">Confirm Password</label>
							<input type="password" class="form-control" name="password_confirmation">
							<?php 
                            if ($errors->first('password_confirmation') == true) {
                                echo '<label class="error">', $errors->first('password_confirmation'), '</label>';
                            }
                        ?> 
                    </div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
			</section>
		</div>
	</div>
</div>
@endsection
