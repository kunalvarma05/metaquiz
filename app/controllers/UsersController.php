<?php

class UsersController extends \BaseController {

	public function connect() {

		/**
		 * Obtain an access token.
		 */
		try {
			$token = Facebook::getTokenFromRedirect();
			//No token received
			if (!$token) {
				//Show error
				return Redirect::to('/') -> with('error', 'Unable to obtain access token.');
			}
		} catch (FacebookQueryBuilderException $e) {
			//Unable to receive token
			return Redirect::to('/') -> with('error', $e -> getPrevious() -> getMessage());
		}

		//If the token is not long lived
		if (!$token -> isLongLived()) {
			/**
			 * Extend the access token.
			 */
			try {
				$token = $token -> extend();
			} catch (FacebookQueryBuilderException $e) {
				//Catch exceptions
				return Redirect::to('/') -> with('error', $e -> getPrevious() -> getMessage());
			}
		}
		//Set the access token
		Facebook::setAccessToken($token);

		/**
		 * Get basic info on the user from Facebook.
		 */
		$facebook_user = "";
		try {
			$facebook_user = Facebook::object('me') -> fields('id', 'name', 'email', 'link', 'friends', 'picture.type(square).width(200).height(200)') -> get();
		} catch (FacebookQueryBuilderException $e) {
			return Redirect::to('/') -> with('error', $e -> getPrevious() -> getMessage());
		}

		//Gather the data
		$data = array();
		//App Scoped ID
		$data['fbid'] = $facebook_user['id'];
		//Email
		$data['email'] = $facebook_user['email'];
		//Name
		$data['name'] = $facebook_user['name'];

		//Check if the user exists
		$user = User::where('fbid', $data['fbid']) -> first();
		if ($user) {
			//User exists, log in the user
			Auth::login($user);
			return Redirect::to('/');
		} else {
			//Fetch the users profile image
			if ($facebook_user['picture']['is_silhouette']) {
				$data['picture'] = null;
			} else {
				$data['picture'] = uploadProfilePic($facebook_user['picture']['url'], Str::random(10));
			}
			//User doesn't exists, create the user
			$user = new User;
			$user -> name = $data['name'];
			$user -> email = $data['email'];
			$user -> fbid = $data['fbid'];
			$user -> username = substr($data['email'], 0, strpos($data['email'], "@"));
			$user -> picture = $data['picture'];
			//Save the user
			if ($user -> save()) {
				//Create a student account
				$student = new Student;
				//Save it
				$student -> save();
				//Morph the student account to the created user's account
				$student -> user() -> save($user);
				//Log in the user
				Auth::login($user);
				//Redirect to home page
				return Redirect::to('/') -> with(array('isNewUser' => true));
			} else {
				return $user -> errors();
			}
		}
	}

	/**
	 * Activate
	 * Activate the account of a given user via a unique code
	 * @return Response
	 */
	public function activate() {
		$code = Input::only('code');
		$validator = Validator::make($code, array('code' => "required"));
		if ($validator -> passes()) {
			$user = User::find(Auth::user() -> id);
			$activation = $user -> activation() -> where('code', '=', $code) -> first();
			if ($activation) {
				$user -> is_activated = true;
				if ($user -> save()) {
					return Redirect::to('/') -> with('flash-message', "Awesome! Your account was activated successfully.");
				} else {
					return $user -> errors();
				}
			} else {
				return Redirect::back() -> with('error', "Incorrect Activation Code");
			}
		} else {
			return Redirect::back() -> with('error', $validator -> messages() -> first());
		}
	}

}
