<?php

class RoutesController extends BaseController {

	/**
	 * Base Route Handler
	 */
	public function baseRoute() {
		//If the user is logged in
		if (Auth::check()) {
			return Redirect::to('home');
			$type = Auth::user() -> accountable_type;
			switch ($type) {
				case 'Student' :
					//Route to Home
					return Redirect::to('home');
					break;
				case 'Teacher' :
					//Route to Faculty
					return Redirect::to('faculty');
					break;
				case 'Admin' :
					//Route to Management
					return Redirect::to('management');
					break;
				default :
					//Route to Home
					return Redirect::to('home');
					break;
			}
		} else {
			//Route to Splash Page
			return View::make('splash');
		}
	}

	/**
	 * Facebook Connect Route Handler
	 */
	public function facebookRoute($id = null) {
		//Only for testing, to be moved inside a controller for production
		if (isset($id) && !empty($id)) {
			$user = User::findOrFail($id);
			Auth::login($user);
			return Redirect::to('/');
		} else {
			return Redirect::to(Facebook::getLoginUrl());
		}
	}

	/**
	 * Activate Route Handler
	 */
	public function activateRoute() {
		//If the user's account is activated
		if (Auth::user() -> is_activated) {
			//Redirect him to the index page
			return Redirect::to('/');
		}
		//Or else ask to enter the activation code
		return View::make('activate-account');
	}

	/**
	 * Logout Route Handler
	 */
	public function logoutRoute() {
		Auth::logout();
		return Redirect::to('/');
	}

}
