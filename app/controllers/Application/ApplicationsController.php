<?php
use MetaQuiz\Repositories\User\UserInterface;

class ApplicationsController extends BaseController {

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

	/**
	 * Application Subjects Page
	 */
	public function subjects() {
		$org = Auth::user() -> organization;
		$courses = Course::with('subjects', 'subjects.chapters') -> where('organization_id', '=', $org -> id) -> get();
		$pageTitle = "Subjects";
		return View::make('app.subjects.index', compact('courses', 'pageTitle'));
	}

	/**
	 * Application Friends Page
	 */
	public function friends(){
		$friends = $this->user->getFriends(Auth::user()->id);
		$pageTitle = "Friends";
		return View::make('app.friends.index', compact('friends','pageTitle'));
	}

}
