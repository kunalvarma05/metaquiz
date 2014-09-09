<?php
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Repositories\Chapter\ChapterInterface;
use MetaQuiz\Service\Form\Chapter\CreateChapterForm;
use MetaQuiz\Service\Form\Chapter\UpdateChapterForm;
use MetaQuiz\Repositories\Organization\OrganizationInterface;

class ManagementChaptersController extends BaseController {

	//The Organization Object
	private $org;
	//The Course Object
	private $course;
	//The Subject Object
	private $subject;
	//The Chapter Object
	private $chapter;
	//The Create Subject Form Object
	private $createChapterForm;
	//The Update Subject Form Object
	private $updateChapterForm;

	public function __construct(OrganizationInterface $org, CourseInterface $course, SubjectInterface $subject, ChapterInterface $chapter, CreateChapterForm $createChapterForm, UpdateChapterForm $updateChapterForm) {
		//Set the objects
		$this -> org = $org;
		$this -> course = $course;
		$this -> subject = $subject;
		$this -> chapter = $chapter;
		$this -> createChapterForm = $createChapterForm;
		$this -> updateChapterForm = $updateChapterForm;
	}

	/**
	 * index Show all the courses of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array Courses Collection
	 */
	public function index($course_id, $subject_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapters = $subject->chapters()->get();
		$pageTitle = $subject->name . " - Chapters";
		return View::make('management.chapters.index', compact('pageTitle','organization','course','subject','chapters'));
	}


	public function create($course_id, $subject_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$pageTitle = $subject->name . " | Create Chapter";
		return View::make('management.chapters.create', compact('pageTitle','organization','course','subject'));
	}


	public function store($course_id, $subject_id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$input['subject_id'] = $subject->id;
		$chapter = $this -> createChapterForm -> create($input);
		if ($chapter) {
			return Redirect::to(URL::route('management.courses.subjects.chapters.index', array($course->id, $subject->id)));
		} else {
			return Redirect::back() -> withErrors($this -> createChapterForm -> errors())->withInput();
		}
	}


	public function show($course_id, $subject_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($id);
		$pageTitle = $subject->name;
		return View::make('management.chapters.show', compact('pageTitle','organization','course','subject','chapter'));
	}


	public function edit($course_id, $subject_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($id);
		$pageTitle = "Edit " . $chapter->name;
		return View::make('management.chapters.edit', compact('pageTitle','organization','course','subject','chapter'));
	}


	public function update($course_id, $subject_id, $id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($id);
		$chapter = $this -> updateChapterForm -> update($id, $input);
		if ($chapter) {
			return Redirect::to(URL::route('management.courses.subjects.chapters.show', array($course->id, $subject->id, $id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateChapterForm -> errors())->withInput();
		}
	}


	public function destroy($course_id, $subject_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($id);
		$delete = $chapter->delete();
		if($delete){
			return Redirect::to(URL::route('management.courses.subjects.chapters.index', array($course->id, $subject->id)));
		}else{
			return Redirect::back();
		}
	}
}