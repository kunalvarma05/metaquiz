<?php
use MetaQuiz\Repositories\User\UserInterface;

class ApplicationsController extends BaseController {

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
		return View::make('app.home.index')->with(array('pageTitle' => "Home", 'activities' => $activities));
	}

	/**
	 * Application Subjects Page
	 */
	public function subjects() {
		$org = Auth::user() -> organization;
		$courses = Course::with('subjects', 'subjects.chapters') -> where('organization_id', '=', $org -> id) -> get();
		return View::make('app.subjects.index') -> with('courses', $courses);
	}

}
