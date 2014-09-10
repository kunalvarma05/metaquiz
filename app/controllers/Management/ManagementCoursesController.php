<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Service\Form\Course\CreateCourseForm;
use MetaQuiz\Service\Form\Course\UpdateCourseForm;

class ManagementCoursesController extends \BaseController {

	//The Organization Object
	private $org;
	private $course;
	private $createCourseForm;
	private $updateCourseForm;

	public function __construct(OrganizationInterface $org, CourseInterface $course, CreateCourseForm $createCourseForm, UpdateCourseForm $updateCourseForm) {
		//Set the objects
		$this -> org = $org;
		$this -> course = $course;
		$this -> createCourseForm = $createCourseForm;
		$this -> updateCourseForm = $updateCourseForm;
	}

	/**
	 * index Show all the courses of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array Courses Collection
	 */
	public function index()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$courses = $organization->courses()->get();
		$pageTitle = $organization->name . " - Courses";
		return View::make('backend.courses.index', compact('pageTitle','organization','courses'));
	}


	public function create()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$pageTitle = $organization->name . " | Create Course";
		return View::make('backend.courses.create', compact('pageTitle','organization'));
	}


	public function store()
	{
		$input = Input::only(array('name', 'description'));
		$input['organization_id'] = Auth::user()->organization_id;
		$course = $this -> createCourseForm -> create($input);
		if ($course) {
			return Redirect::to(URL::route('management.courses.index'));
		} else {
			return Redirect::back() -> withErrors($this -> createCourseForm -> errors())->withInput();
		}
	}


	public function show($id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->with('subjects')->findOrFail($id);
		$pageTitle = $course->name;
		return View::make('backend.courses.show', compact('pageTitle','organization','course'));
	}


	public function edit($id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($id);
		$pageTitle = "Edit " . $course->name;
		return View::make('backend.courses.edit', compact('pageTitle','organization','course'));
	}


	public function update($id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($id);
		$course = $this -> updateCourseForm -> update($course->id, $input);
		if ($course) {
			return Redirect::to(URL::route('management.courses.show', array($id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateCourseForm -> errors())->withInput();
		}
	}


	public function destroy($id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($id);
		$delete = $course->delete();
		if($delete){
			return Redirect::to(URL::route('management.courses.index'));
		}else{
			return Redirect::back();
		}
	}

}