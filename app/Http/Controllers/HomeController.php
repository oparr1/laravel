<?php namespace App\Http\Controllers;

// Can use ApplicationFormRequest for all validation
use App\Http\Requests\ContactFormRequest;
// Model
use App\MySqlQuery;
// Needed to access DB::
use DB;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/*
	// Default Middlewares allow all access unless specified below to grant single access 
	public function __construct()
	{
		$this->middleware('guest'); // changed from auth
	}
	*/

	/**
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function about()
	{
		return view('about');
	}

	public function contact()
	{
		return view('contact');
	}

	// app/Http/Requests/ContactFormRequest.php
	public function contactForm(ContactFormRequest $request)
    {
    	// Assign variables
    	$contactName = $request->get('name');
    	$contactEmail = $request->get('email');
    	$contactMessage = $request->get('message');

    	// Pass data into array for sending to($contactEmail)
    	$data = array('name'=>$contactName, 'email'=>$contactEmail, 'user_message'=>$contactMessage);

    	// Templated Email - Html and Text, resources/views/emails/html and resources/views/emails/text
    	\Mail::send(['emails.html.contact', 'emails.text.contact'], $data, function($message)
		{
	        $message->from('email', null); // 'label'
	        $message->to('email', null) // 'label'
	        ->subject('Contact Us');
	    });

    	// Templated Email - Html and Text, resources/views/emails/html and resources/views/emails/text
	    \Mail::send(['emails.html.contact_confirm', 'emails.text.contact_confirm'], $data, function($message) use ($contactEmail) // pass $contactEmail through
	    {   
	        $message->from('email', null); // 'label'
	        $message->to($contactEmail, null) // 'label'
	        ->subject('We have recieved your message');
	    });

	    /*
		$contactEmail = $request->get('email');

    	// Templated Email - Html and Text
    	\Mail::send(['emails.html.contact', 'emails.text.contact'], // resources/views/emails/html and resources/views/emails/text
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function($message)
		{
	        $message->from('email', null); // 'label'
	        $message->to('email', null) // 'label'
	        ->subject('Contact Us');
	    });

    	// Sending Confirmation Email Back
    	\Mail::send(['emails.html.contact_confirm', 'emails.text.contact_confirm'],
    	array(
            'name' => $request->get('name'),
            'user_message' => $request->get('message')
        ), function($message) use ($contactEmail)
	    {
	    	$message->from('email', null); // 'label'
	    	$message->to($contactEmail)
	    	->subject('We have received your message');
	    });
	    */

	    // Flash message if success
    	\Session::flash('message', 'Thank you for contacting us! We will get back to you shortly.');
    	return view('contact');
    }

	public function cookies()
	{
		return view('cookies');
	}

	public function static_site()
	{
		return view('static');
	}

	public function sqlquery()
	{
		// Declare the model - use App\MySqlQuery;
		// $Variable = Model Name

		// All Tables
		$mySqlQuery = MySqlQuery::all();
		// Table Specific
		// $mySqlQueryTable = DB::table('country')->get();

		// One Value
		$oneValue = MySqlQuery::where('Name', 'United Kingdom')->pluck('Name');

		// One Row
		$firstRow = MySqlQuery::where('Name', '=', 'United Kingdom')
		->select('Code', 'Name AS Country', 'Continent', 'Region', 'SurfaceArea AS Surface_Area', 'Population', 'LifeExpectancy AS Life_Expectancy')
		->get()
		->toArray();

		// One Column - echo $firstColumn->Name
		$firstColumn = MySqlQuery::orderBy('Name', 'asc')
				->take(20)
                ->get();
		// $firstColumn = MySqlQuery::lists('Name');

		//Multiple Rows
		$multipleRows = MySqlQuery::where('Name', '=', 'United Kingdom')
		->orWhere('Name', '=', 'Netherlands')
		->orWhere('Name', '=', 'Spain')
		->select('Code', 'Name AS Country', 'Continent', 'Region', 'SurfaceArea AS Surface_Area', 'Population', 'LifeExpectancy AS Life_Expectancy')
		->orderBy('Code', 'asc')
		->get()
		->toArray();

		// Aggregates - Life Expectancy
		$aggregates = MySqlQuery::select('LifeExpectancy')
		->where('Continent', 'Europe')
		->avg('LifeExpectancy');
		// 2 Decimal places
		$aggregatesDecimal = number_format((float)$aggregates, 2, '.', '');

		// Groupby 
		$groupBy = MySqlQuery::select('Continent', 'Region', DB::raw('count(*) as Total_Countries'))
                 ->groupBy('Continent', 'Region')
                 ->orderBy('Total_Countries', 'DESC')
                 ->get()
                 ->toArray();

        // Join - Get result of joining multiple tables as one row
        $joinTable = DB::table('country')
        	->join('countrylanguage', 'country.Code', '=', 'countrylanguage.CountryCode')
        	->where('countrylanguage.IsOfficial', '=', 'T')
        	->where('country.Continent', '=', 'Europe')
        	->select(array('country.Name AS Country', DB::raw('GROUP_CONCAT(DISTINCT Language ORDER BY Language ASC) AS Official_Language')))
        	->orderBy('Name', 'ASC')
        	->groupBy('Name')
            ->get();

        // Random List
        $randomOrder = MySqlQuery::select('Name AS Country')
        ->orderBy(DB::raw('RAND()'))
        ->take(20)
        ->get()
        ->toArray();

		// where - where column name =, <, > to a value
		// orderBy - Orders ascending/descending
       	// select - selects columns
       	// groupby - group by a certain field e.g countries per continent
       	// having - use with groupby 'where' for aggregates
       	// distinct - selecting number of unique (1) values in a given column
       	// join -  join two seperate tables together     
       	// avg, sum, count, min, max - useful for numbers   
		// take - number of first records to be shown
        // get - gets the results after everything
        // toArray - passes it as array - good for using only one set of column fields

		// (Controller Name)->with(variable, $variable)
		return view('sqlquery')
		->with('oneValue', $oneValue)
		->with('firstRow', $firstRow)
		->with('firstColumn', $firstColumn)
		->with('multipleRows', $multipleRows)
		->with('aggregatesDecimal', $aggregatesDecimal)
		->with('groupBy', $groupBy)
		->with('joinTable', $joinTable)
		->with('randomOrder', $randomOrder);
	}
}
