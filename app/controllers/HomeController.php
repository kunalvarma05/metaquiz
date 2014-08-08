<?php

class HomeController extends BaseController {

	/**
	 * Application Home Page
	 */
	public function home() {
		return View::make('app.home.index');
	}

}
