<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Student\StudentInterface;
use MetaQuiz\Repositories\Activation\ActivationInterface;
use MetaQuiz\Service\Form\Student\CreateStudentForm;
use MetaQuiz\Service\Form\Student\UpdateStudentForm;

class ManagementStudentsController extends \BaseController {

	//The Organization Object
	private $org;
	private $user;
	private $student;
	private $createStudentForm;
	private $updateStudentForm;
	private $activation;

	public function __construct(OrganizationInterface $org, StudentInterface $student, CreateStudentForm $createStudentForm, UpdateStudentForm $updateStudentForm, ActivationInterface $activation, UserInterface $user) {
		//Set the objects
		$this -> org = $org;
		$this -> user = $user;
		$this -> student = $student;
		$this -> createStudentForm = $createStudentForm;
		$this -> updateStudentForm = $updateStudentForm;
		$this -> activation = $activation;
	}

	/**
	 * index Show all the students of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array students Collection
	 */
	public function index()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id, array('students', 'students.accountable'));
		$students = $organization->students;
		$pageTitle = $organization->name . " - Students";
		return View::make('backend.students.index', compact('pageTitle','organization','students'));
	}


	public function create()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$pageTitle = $organization->name . " | Create Student";
		$courses = array();
		foreach ($organization->courses as $course) {
			$courses[$course->id] = $course->name;
		}
		return View::make('backend.students.create', compact('pageTitle','organization','courses'));
	}


	public function store()
	{
		$input = Input::only(array('roll_no', 'course_id'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);

		$input['organization_id'] = $organization->id;
		$student = $this -> createStudentForm -> create($input);

		if ($student) {
			//Generate Random Code
			$code = randomCode($student->roll_no);
			$data = array('code' => $code, 'organization_id' => $organization->id);
			//Create new activation
			$activation = $this->activation->create($data);
			//Associate the activation with the student
			$save = $student->activation()->save($activation);
			if($save){
				$eventData['code'] = $code;
				$eventData['roll_no'] = $student->roll_no;
				Event::fire('student.invite', array($eventData));
				return Redirect::to(URL::route('management.students.index'));
			}else{
				return Redirect::back() -> withErrors(array('Something went wrong! Please try again.'))->withInput();
			}
		} else {
			return Redirect::back() -> withErrors($this -> createStudentForm -> errors())->withInput();
		}
	}


	public function show($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$student = $organization->students()->findOrFail($user_id);
		$pageTitle = $student->name;
		return View::make('backend.students.show', compact('pageTitle','organization','student'));
	}


	public function edit($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$student = $organization->students()->findOrFail($user_id);
		$pageTitle = "Edit " . "-" . $student->name;
		$courses = array();
		foreach ($organization->courses as $course) {
			$courses[$course->id] = $course->name;
		}
		return View::make('backend.students.edit', compact('pageTitle','organization','student','courses'));
	}


	public function update($user_id)
	{
		$input = Input::only(array('roll_no', 'course_id'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$student = $organization->students()->findOrFail($user_id);
		$update = $this -> updateStudentForm -> update($student->accountable->id, $input);
		if ($update) {
			return Redirect::to(URL::route('management.students.show', array($user_id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateStudentForm -> errors())->withInput();
		}
	}


	public function destroy($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$student = $organization->students()->findOrFail($user_id);
		$delete = $student->delete();
		if($delete){
			return Redirect::to(URL::route('management.students.index'));
		}else{
			return Redirect::back();
		}
	}
}