<?php

use MetaQuiz\Service\Form\Activate\ActivateForm;

class ActivationController extends \BaseController {

	/**
	 * The Activate Form Class Object
	 */
	protected $activateForm;

	/**
	 * The Constructor
	 */
	public function __construct(ActivateForm $activateForm) {
		$this -> activateForm = $activateForm;
	}

	/**
	 * Display a listing of the resource.
	 * GET /activation
	 *
	 * @return Response
	 */
	public function form() {
		return View::make('global.activate-account') -> with(array('pageTitle' => "Activate your Account"));
	}

	/**
	 * Handle the Activation form submission
	 */
	public function activate() {
		$code = Input::get('code');
		$activatedUser = $this -> activateForm -> activate(Auth::user() -> id, $code);
		if ($activatedUser) {
			$role = Role::where('name',$activatedUser->accountable_type)->first();
			$activatedUser->attachRole($role);
			if($activatedUser->accountable_type === "Faculty"){
				$data = array('faculty' => $activatedUser->name, 'organization' => $activatedUser->organization->name, 'name' => $activatedUser->organization->manager->name, 'email' => $activatedUser->organization->manager->email);
				Event::fire('faculty.join', array($data));
			}
			return Redirect::to('/');
		} else {
			return Redirect::back() -> withErrors($this -> activateForm -> errors());
		}
	}

}
