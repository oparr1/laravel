<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

// Email Activation
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		// Services/registrar.php
		$this->registrar = $registrar;

		// $this->middleware('guest', ['except' => 'getLogout']);
		$this->middleware('guest',
			['except' =>
				['getLogout', 'resendEmail', 'activateAccount']]);

	}

	    public function postLogin (Request $request)
    	{
        $this->validate($request,[
           'email'=>'required', 'password'=>'required',
        ]);
        $credentials = $request->only('email', 'password');
        $credentials['active'] = 1;

        if($this->auth->attempt($credentials, $request->has('remember'))){
            return redirect()->intended($this->redirectPath());
        }
        $user = User::whereEmail($credentials['email'])->first();
        if($user AND ! $user->active){
            //\Session::flash('message','Please activate your account to proceed');
            return view('auth.guest_activate')
				->with( 'email', $user->email )
				->with( 'date', $user->created_at->format('Y-m-d') );
        } else {
            return redirect($this->loginPath())
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => $this->getFailedLoginMessage(),
                ]);
        }
    	}


	//Email Verification

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		$validator = $this->registrar->validator($request->all());
	
		if ($validator->fails())
		{
			$this->throwValidationException(
					$request, $validator
			);
		}
		$activation_code = str_random(60) . $request->input('email');
		$user = new User;
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));
		$user->activation_code = $activation_code;
		
		if ($user->save()) {
			$this->sendEmail($user);
			return view('auth.activateAccount')
				->with('email', $request->input('email'));
		
		} else {
			
			\Session::flash('message', \Lang::get('notCreated') );
			return redirect()->back()->withInput();
			
		}
	}
	
	public function sendEmail(User $user)
	{
		$data = array(
				'name' => $user->name,
				'code' => $user->activation_code,
		);
		
		\Mail::queue('emails.activateAccount', $data, function($message) use ($user) {
			$message->subject( \Lang::get('auth.pleaseActivate') );
			$message->to($user->email);
		});
	}
	
	public function activateAccount($code, User $user)
	{
		if($user->accountIsActive($code)) {
			\Session::flash('message', \Lang::get('auth.successActivated') );
			return redirect('home');
		}
	
		\Session::flash('message', \Lang::get('auth.unsuccessful') );
		return redirect('home');
	
	}

}
