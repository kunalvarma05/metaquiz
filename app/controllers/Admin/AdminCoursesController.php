<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Service\Form\Course\CreateCourseForm;
use MetaQuiz\Service\Form\Course\UpdateCourseForm;

class AdminCoursesController extends \BaseController {

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
	public function index($organization_id)
	{		
		$organization = $this->org->requireByID($organization_id, array('courses'));
		$pageTitle = $organization->name . " | Courses";
		return View::make('admin.courses.index')->with(compact('organization','pageTitle'));
	}


	public function create($organization_id)
	{
		$organization = $this->org->requireByID($organization_id);
		$pageTitle = $organization->name . " | Create Course";
		return View::make('admin.courses.create')->with(compact('organization','pageTitle'));
	}


	public function store($organization_id)
	{
		$input = Input::only(array('name', 'description', 'icon', 'organization_id'));
		$course = $this -> createCourseForm -> create($input);
		if ($course) {
			return Redirect::to(URL::route('admin.organizations.courses.index', $course->organization_id));
		} else {
			return Redirect::back() -> withErrors($this -> createCourseForm -> errors())->withInput();
		}
	}


	public function show($organization_id, $id)
	{
		$course = $this -> org -> requireByID($organization_id)->courses()->with(array('subjects'))->findOrFail($id);
		$pageTitle = $course->name;		
		return View::make('admin.courses.show', compact('pageTitle', 'course'));
	}


	public function edit($organization_id, $id)
	{
		$course = $this -> org -> requireByID($organization_id)->courses()->findOrFail($id);	
		$pageTitle = "Edit " . $course->name;
		return View::make('admin.courses.edit') -> with(compact('pageTitle', "course"));
	}

	
	public function update($organization_id, $id)
	{
		$input = Input::only(array('name', 'description'));
		$course = $this -> updateCourseForm -> update($id, $input);
		if ($course) {
			return Redirect::to(URL::route('admin.organizations.courses.show', array($organization_id, $id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateCourseForm -> errors())->withInput();
		}
	}

	
	public function destroy($organization_id, $id)
	{
		$delete = $this->org->requireByID($organization_id)->courses()->findOrFail($id)->delete();
		if($delete){
			return Redirect::to(URL::route('admin.organizations.courses.index', $organization_id));
		}else{
			return Redirect::back();
		}
	}

}