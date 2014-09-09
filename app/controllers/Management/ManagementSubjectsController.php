<?php
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Service\Form\Subject\CreateSubjectForm;
use MetaQuiz\Service\Form\Subject\UpdateSubjectForm;
use MetaQuiz\Repositories\Organization\OrganizationInterface;

class ManagementSubjectsController extends \BaseController {

	//The Organization Object
	private $org;
	//The Course Object
	private $course;
	//The Subject Object
	private $subject;
	//The Create Subject Form Object
	private $createSubjectForm;
	//The Update Subject Form Object
	private $updateSubjectForm;

	public function __construct(OrganizationInterface $org, CourseInterface $course, SubjectInterface $subject, CreateSubjectForm $createSubjectForm, UpdateSubjectForm $updateSubjectForm) {
		//Set the objects
		$this -> org = $org;
		$this -> course = $course;
		$this -> subject = $subject;
		$this -> createSubjectForm = $createSubjectForm;
		$this -> updateSubjectForm = $updateSubjectForm;
	}

	/**
	 * index Show all the courses of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array Courses Collection
	 */
	public function index($course_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->with('subjects')->findOrFail($course_id);
		$pageTitle = $course->name . " - Subjects";
		return View::make('management.subjects.index', compact('pageTitle','organization','course'));
	}


	public function create($course_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$pageTitle = $course->name . " | Create Subject";
		return View::make('management.subjects.create', compact('pageTitle','organization','course'));
	}


	public function store($course_id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$input['course_id'] = $course->id;
		$subject = $this -> createSubjectForm -> create($input);
		if ($subject) {
			return Redirect::to(URL::route('management.courses.subjects.index', $course->id));
		} else {
			return Redirect::back() -> withErrors($this -> createSubjectForm -> errors())->withInput();
		}
	}


	public function show($course_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->with('chapters')->findOrFail($id);
		$pageTitle = $subject->name;
		return View::make('management.subjects.show', compact('pageTitle','organization','course','subject'));
	}


	public function edit($course_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($id);
		$pageTitle = "Edit " . $subject->name;
		return View::make('management.subjects.edit', compact('pageTitle','organization','course','subject'));
	}


	public function update($course_id, $id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($id);
		$subject = $this -> updateSubjectForm -> update($subject->id, $input);
		if ($subject) {
			return Redirect::to(URL::route('management.courses.subjects.show', array($course->id, $id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateSubjectForm -> errors())->withInput();
		}
	}


	public function destroy($course_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($id);
		$delete = $subject->delete();
		if($delete){
			return Redirect::to(URL::route('management.courses.subjects.index', $course->id));
		}else{
			return Redirect::back();
		}
	}
}