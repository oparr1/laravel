@extends('app')

@section('content')
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col8">
            <section id="sectionPadding">

				<div class="panel-body">
					<p>An email was sent to {{ $email }} on {{ $date }}.</p>

					<p>{{ Lang::get('auth.clickInEmail') }}</p>
				</div>
			</section>
		</div>
	</div>
</div>
@endsection
