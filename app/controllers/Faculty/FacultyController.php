<?php
class FacultyController extends \BaseController {
	/**
	 * Redirect to the Dashboard
	 */
	public function index(){
		return Redirect::to(URL::route('faculty.dashboard'));
	}

	/**
	 * Display a listing of the resource.
	 * GET /faculty
	 *
	 * @return Response
	 */
	public function dashboard() {
		$pageTitle = "Dashboard";
		return View::make('backend.dashboard', compact('pageTitle'));
	}

}
