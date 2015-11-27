@extends('app')

@section('content')

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
    function initialize() {

        var myLatlng = new google.maps.LatLng(52.923073, -1.477864);
        var mapOptions = {
            zoom: 13, // The initial zoom level when your map loads (0-20)
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP // Set the type of Map
        }

        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng, // Position marker to coordinates
            map: map, // assign the market to our map variable
            title: 'Click to visit our company on Google Places' // Marker ALT Text
        });
        google.maps.event.addDomListener(window, 'resize', function () { map.setCenter(myLatlng); });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div id="mapcontainer">
    <div id="map-canvas">
    </div>
</div>
<div id="address">
    <div class="onepcssgrid-1200">
        <div class="onerow">
            <p><span>Address:</span>123 Fake Street, Town, City, Post Code, Phone Number</p>
        </div> <!-- Row Closing -->
    </div> <!-- 1200 Closing -->
</div>
<div class="onepcssgrid-1200">
    <div class="onerow">
        <div class="col9">
            <section>

                <h3>Contact Us</h3>
                <!-- Validation Summary -->
                <!--
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                -->
                @if(Session::has('message'))
                <div class="message success">
                  {{Session::get('message')}}
                </div>
                <!-- novalidate required to disable html5 browser validation -->
                @endif
                {!! Form::open(array('route' => 'contact_form', 'class' => 'form', 'id' => 'contact', 'novalidate' => '' )) !!}
                <div class="form-group">
                    <div class="contacttooltips">
                        {!! Form::label('Name:', null, array('class' => 'required')) !!}
                        {!! Form::text('name', null, 
                            array('required', 
                                  'class'=>'form-control', 
                                  'placeholder'=>'')) !!}
                        <!-- Simple Validation // Laravel way -->
                        <?php /* echo $errors->first('name'); */ ?> {{-- {{ $errors->first('name') }} --}}

                        <!-- Styling validation -->
                        <?php 
                            if ($errors->first('name') == true) {
                                echo '<label class="error">', $errors->first('name'), '</label>';
                            }
                        ?>        

                        <!-- Laravel styling validaiton -->
                        {{-- Laravel way {!! !!} *required for raw html* --}}                   
                        {{--
                        @if ($errors->has('name'))
                        {!! $errors->first('name', '<label class="error">:message<label>') !!}
                        @endif
                        --}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="contacttooltips">
                        {!! Form::label('E-mail Address:', null, array('class' => 'required')) !!}
                        {!! Form::text('email', null, 
                            array('required', 
                                  'class'=>'form-control', 
                                  'placeholder'=>'')) !!}

                        <?php 
                            if ($errors->first('email') == true) {
                                echo '<label class="error">', $errors->first('email'), '</label>';
                            }
                        ?>    
                    </div>
                </div>

                <div class="form-group">
                    <div class="contacttooltipstextarea">
                        {!! Form::label('Message:', null, array('class' => 'required')) !!}
                        {!! Form::textarea('message', null, 
                            array('required', 
                                  'class'=>'form-control', 
                                  'placeholder'=>'')) !!}

                        <?php 
                            if ($errors->first('message') == true) {
                                echo '<label class="error">', $errors->first('message'), '</label>';
                            }
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    {{-- {!! Form::submit('Submit', 
                      array('class'=>'btn btn-primary')) !!} --}}
                      <button type="submit">Submit</button>
                </div>
                {!! Form::close() !!}
            </section>
        </div>
    </div> <!-- Row Closing -->
</div> <!-- 1200 Closing -->

@section('scripts')
<script>
$("#contact").validate({
    rules: {
        name: {
          required: true,
          minlength: 2,
          maxlength: 50
        },
        email: {
            required: true,
            email: true
        },
        message: {
            required: true,
            minlength: 10,
            maxlength: 500
        }
    },
    messages: {
        name: {
            required: "A name is required",
            minlength: "A name must have 2 or more characters",
            maxlength: "A name must have 50 or less characters"
        },
        email: {
            required: "An email address is required",
            email: "A valid email address is required"
        },
        message: {
            required: "A message is required",
            minlength: "A message must have 10 or more characters",
            maxlength: "A message must have 500 or less characters"
        }
    }
});
</script>
@stop

@endsection


