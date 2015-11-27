var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	// Must name css location otherwise will default to public/css/app.css
	// mix.less("styless.less, "public/css/styless.css");
    mix.less("styles.less", "resources/css/styles.css");
    // Css Pre-Bundle Location, CSS Destination, CSS Pre-Bundle Directory
    mix.styles(["styles.css", "owl.carousel.css", "owl.theme.css", "owl.transitions.css", "onepcssgrid.css"], 'public/css/styles.css', 'resources/css/');

});
