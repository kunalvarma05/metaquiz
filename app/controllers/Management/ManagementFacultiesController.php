<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Faculty\FacultyInterface;
use MetaQuiz\Repositories\Activation\ActivationInterface;
use MetaQuiz\Service\Form\Faculty\CreateFacultyForm;
use MetaQuiz\Service\Form\Faculty\UpdateFacultyForm;

class ManagementFacultiesController extends \BaseController {

	//The Organization Object
	private $org;
	private $user;
	private $faculty;
	private $createFacultyForm;
	private $updateFacultyForm;
	private $activation;

	public function __construct(OrganizationInterface $org, FacultyInterface $faculty, CreateFacultyForm $createFacultyForm, UpdateFacultyForm $updateFacultyForm, ActivationInterface $activation, UserInterface $user) {
		//Set the objects
		$this -> org = $org;
		$this -> user = $user;
		$this -> faculty = $faculty;
		$this -> createFacultyForm = $createFacultyForm;
		$this -> updateFacultyForm = $updateFacultyForm;
		$this -> activation = $activation;
	}

	/**
	 * index Show all the faculties of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array faculties Collection
	 */
	public function index()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id, array('faculties', 'faculties.accountable'));
		$faculties = $organization->faculties;
		$pageTitle = $organization->name . " - Faculties";
		return View::make('backend.faculties.index', compact('pageTitle','organization','faculties'));
	}


	public function create()
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$courses = $organization->courses()->with(array('subjects'))->get();
		$pageTitle = $organization->name . " | Create Faculty";
		$subjects = array();
		foreach ($courses as $course) {
			foreach ($course->subjects as $subject) {
				$subjects[$subject->id] = $subject->name;
			}
		}
		return View::make('backend.faculties.create', compact('pageTitle','organization','courses', 'subjects'));
	}


	public function store()
	{
		$input = Input::only(array('gr_no', 'subjects'));
		$emailData = Input::only(array('gr_no','subjects','email', 'name'));
		$exists = $this->user->getFirstBy('email', $emailData['email']);
		if($exists){
			return Redirect::back() -> withErrors(array('Sorry! A user with this email is already there on some other organization.'))->withInput();
		}
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id, array('manager'));

		$emailData['organization'] = $organization->name;
		$emailData['manager'] = $organization->manager->name;

		$input['organization_id'] = $organization->id;
		$faculty = $this -> createFacultyForm -> create($input);

		if ($faculty) {
			//Generate Random Code
			$code = randomCode($faculty->gr_no);
			$data = array('code' => $code, 'organization_id' => $organization_id);
			//Create new activation
			$activation = $this->activation->create($data);
			//Associate the activation with the faculty
			$save = $faculty->activation()->save($activation);
			if($save){
				$emailData['code'] = $code;
				Event::fire('faculty.invite', array($emailData));
				return Redirect::to(URL::route('management.faculties.index'));
			}else{
				return Redirect::back() -> withErrors(array('Something went wrong! Please try again.'))->withInput();
			}
		} else {
			return Redirect::back() -> withErrors($this -> createFacultyForm -> errors())->withInput();
		}
	}


	public function show($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$faculty = $organization->faculties()->findOrFail($user_id);
		$pageTitle = $faculty->name;
		return View::make('backend.faculties.show', compact('pageTitle','organization','faculty'));
	}


	public function edit($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$faculty = $organization->faculties()->findOrFail($user_id);
		$courses = $organization->courses()->with(array('subjects'))->get();
		$pageTitle = "Edit " . "-" . $faculty->name;
		$subjects = array();
		foreach ($courses as $course) {
			foreach ($course->subjects as $subject) {
				$subjects[$subject->id] = $subject->name;
			}
		}
		$assignedSubjects = array_pluck($faculty->accountable->subjects, 'id');
		return View::make('backend.faculties.edit', compact('pageTitle','organization','faculty', 'subjects','assignedSubjects'));
	}


	public function update($user_id)
	{
		$input = Input::only(array('gr_no', 'subjects'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$faculty = $organization->faculties()->findOrFail($user_id);
		$update = $this -> updateFacultyForm -> update($faculty->accountable->id, $input);
		if ($update) {
			if($input['subjects']){
				$faculty->accountable->subjects()->sync($input['subjects']);
			}
			return Redirect::to(URL::route('management.faculties.show', array($user_id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateFacultyForm -> errors())->withInput();
		}
	}


	public function destroy($user_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$faculty = $organization->faculties()->findOrFail($user_id);
		$delete = $faculty->delete();
		if($delete){
			return Redirect::to(URL::route('management.faculties.index'));
		}else{
			return Redirect::back();
		}
	}
}