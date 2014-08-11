<?php

class AdminsController extends BaseController {

	public function dashboard() {
		$org = Auth::user() -> organization;
		return View::make('management.dashboard.index');
	}

}
