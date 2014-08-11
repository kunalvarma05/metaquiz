<?php
class ApplicationsController extends BaseController {

	/**
	 * Application Home Page
	 */
	public function homePage() {
		return View::make('app.home.index');
	}

	/**
	 * Application Subjects Page
	 */
	public function subjectsPage() {
		return View::make('app.subjects.index');
	}

}
