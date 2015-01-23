<?php
use MetaQuiz\Repositories\User\UserInterface;

class DashboardController extends BaseController {

	//The User Interface Object
	private $user;

	public function __construct(UserInterface $user){
		$this->user = $user;
	}

	/**
	 * Index
	 */
	public function index(){
		return Redirect::to(route('app.home'));
	}

	/**
	 * Application Home
	 */
	public function home() {
		$activities = $this->user->feed(Auth::user()->id);
		$pageTitle = "Home";
		return View::make('app.home.index', compact('pageTitle', 'activities'));
	}

}
