@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col8">
            <section id="sectionPadding">
			<div class="panel panel-default">
				<div class="panel-body">
					@if (session('status'))
						<div class="message success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="message error">
							Failed to reset password. Check to see if you entered your email correctly.
						</div>
					@endif

					<h3>Reset your password</h3>
        			<hr />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
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
