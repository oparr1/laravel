<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Home Page
Route::get('/', 'HomeController@index');
	// Redirect Home to /
	Route::get('home', function()
	{
	   return redirect('/');
	});
// About Us
Route::get('about-us', 'HomeController@about');
		// Redirect about to about-us
	Route::get('about', function()
	{
	   return redirect('about-us');
	});
// Contact Page and Contact Form	
Route::get('contact', 'HomeController@contact');
Route::post('contact', 
  ['as' => 'contact_form', 'uses' => 'HomeController@contactForm']);
// Cookie Policy
Route::get('cookie-policy', 'HomeController@cookies');
// Static Site
Route::get('static', 'HomeController@static_site');

Route::get('sql-query', 'HomeController@sqlquery');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Email Authentication
Route::get('/resendEmail', 'Auth\AuthController@resendEmail');
Route::get('/activate/{code}', 'Auth\AuthController@activateAccount');

/* 
// Test Email Configuration
Route::get('test', function()
{
    dd(Config::get('mail'));
});
*/
