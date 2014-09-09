<?php

class RoutesController extends BaseController {

	/**
	 * Base Route Handler
	 */
	public function baseRoute() {
		if (Auth::check()) {
			$user = Auth::user();
			if ($user -> hasRole('Admin')) {
				return Redirect::to(URL::route('admin'));
			}
			$type = $user -> accountable_type;
			switch ($type) {
				case 'Manager' :
					return Redirect::to(URL::route('management'));
					break;
				case 'Faculty' :
					return Redirect::to(URL::route('faculty'));
					break;
				case 'Student' :
					return Redirect::to(URL::route('app'));
					break;
				default :
					return View::make('splash.splash');
					break;
			}
		}
		return View::make('splash.splash');
	}

	/**
	 * Facebook Connect Route Handler
	 */
	public function facebookRoute() {
		return Redirect::to(Facebook::getLoginUrl());
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
