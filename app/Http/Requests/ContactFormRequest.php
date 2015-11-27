<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// change to true
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|min:2|max:50',
		    'email' => 'required|email',
		    'message' => 'required|min:10|max:500',
		];
	}
		// Custom Validation Messages - resources/lang/en/validation.php - under custom
}
