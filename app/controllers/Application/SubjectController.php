<?php
use MetaQuiz\Repositories\User\UserInterface;

class SubjectController extends BaseController {

	//The User Interface Object
	private $user;

	public function __construct(UserInterface $user){
		$this->user = $user;
	}

	/**
	 * Index
	 */
	public function index(){
		$org = Auth::user() -> organization;
		$courses = Course::with('subjects', 'subjects.chapters') -> where('organization_id', '=', $org -> id) -> get();
		$pageTitle = "Subjects";
		return View::make('app.subjects.index', compact('courses', 'pageTitle'));
	}

}