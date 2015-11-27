@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col9">
            <section id="sectionPadding">
			<div class="panel panel-default">
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="message error">
							Failed to reset password. Check to see if you entered your input correctly.
						</div>
					@endif

					<h3>Reset your password</h3>
					<hr />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

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
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
@endsection
