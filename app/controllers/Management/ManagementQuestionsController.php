<?php
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;
use MetaQuiz\Repositories\Chapter\ChapterInterface;
use MetaQuiz\Repositories\Question\QuestionInterface;
use MetaQuiz\Service\Form\Question\CreateQuestionForm;
use MetaQuiz\Service\Form\Question\UpdateQuestionForm;
use MetaQuiz\Repositories\Organization\OrganizationInterface;

class ManagementQuestionsController extends BaseController {

	//The Organization Object
	private $org;
	//The Course Object
	private $course;
	//The Subject Object
	private $subject;
	//The Chapter Object
	private $chapter;
	//The Question Object
	private $question;
	//The Create Question Form Object
	private $createQuestionForm;
	//The Update Question Form Object
	private $updateQuestionForm;

	public function __construct(OrganizationInterface $org, CourseInterface $course, SubjectInterface $subject, ChapterInterface $chapter, QuestionInterface $question, CreateQuestionForm $createQuestionForm, UpdateQuestionForm $updateQuestionForm) {
		//Set the objects
		$this -> org = $org;
		$this -> course = $course;
		$this -> subject = $subject;
		$this -> chapter = $chapter;
		$this -> question = $question;
		$this -> createQuestionForm = $createQuestionForm;
		$this -> updateQuestionForm = $updateQuestionForm;
	}

	/**
	 * index Show all the courses of the given organization
	 * @param  Integer $organization_id  Organization ID
	 * @return Array Courses Collection
	 */
	public function index($course_id, $subject_id, $chapter_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$questions = $chapter->questions()->with(array('options'))->simplePaginate(30);
		$pageTitle = $subject->name . " - Questions";
		return View::make('management.questions.index', compact('pageTitle','organization','course','subject','chapter','questions'));
	}


	public function create($course_id, $subject_id, $chapter_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$pageTitle = $subject->name . " | Add Question";
		return View::make('management.questions.create', compact('pageTitle','organization','course','subject', 'chapter'));
	}


	public function store($course_id, $subject_id, $chapter_id)
	{
		$input = Input::only(array('title', 'option_one', 'option_two', 'option_three', 'answer'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$input['chapter_id'] = $chapter->id;
		$question = $this -> createQuestionForm -> create($input);
		$option_one = $question->options()->create(array('title' => $input['option_one']));
		$option_two = $question->options()->create(array('title' => $input['option_two']));
		$option_three = $question->options()->create(array('title' => $input['option_three']));
		$answer = $question->options()->create(array('title' => $input['answer'], 'is_answer' => true));
		if ($question) {
			return Redirect::to(URL::route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter->id, $question->id)));
		} else {
			return Redirect::back() -> withErrors($this -> createQuestionForm -> errors())->withInput();
		}
	}


	public function show($course_id, $subject_id, $chapter_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$question = $chapter->questions()->findOrFail($id);
		$pageTitle = $subject->name;
		return View::make('management.questions.show', compact('pageTitle','organization','course','subject','chapter', 'question'));
	}


	public function edit($course_id, $subject_id, $chapter_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$question = $chapter->questions()->findOrFail($id);
		$pageTitle = "Edit " . $chapter->name;
		return View::make('management.questions.edit', compact('pageTitle','organization','course','subject','chapter'));
	}


	public function update($course_id, $subject_id, $chapter_id, $id)
	{
		$input = Input::only(array('name', 'description'));
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$question = $chapter->questions()->findOrFail($id);
		$update = $this -> updateQuestionForm -> update($id, $input);
		if ($update) {
			return Redirect::to(URL::route('management.courses.subjects.chapters.questions.show', array($course->id, $subject->id, $chapter_id, $question->id)));
		} else {
			return Redirect::back() -> withErrors($this -> updateQuestionForm -> errors())->withInput();
		}
	}


	public function destroy($course_id, $subject_id, $chapter_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$question = $chapter->questions()->findOrFail($id);
		$delete = $chapter->delete();
		if($delete){
			return Redirect::to(URL::route('management.courses.subjects.Questions.index', array($course->id, $subject->id)));
		}else{
			return Redirect::back();
		}
	}

	/**
	 * Import questions Form
	 * @param  Integer $course_id  The Course ID
	 * @param  Integer $subject_id The Subject ID
	 * @param  Integer $chapter_id The Chapter ID
	 * @return mixed               Response
	 */
	public function import($course_id, $subject_id, $chapter_id) {
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		return View::make('management.questions.import', compact('pageTitle','organization','course','subject','chapter'));
	}

	/**
	 * Import questions from a Excel file
	 * @param  Integer $course_id  The Course ID
	 * @param  Integer $subject_id The Subject ID
	 * @param  Integer $chapter_id The Chapter ID
	 * @return mixed               Response
	 */
	public function importPost($course_id, $subject_id, $chapter_id) {
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		if (Input::hasFile('file')) {
			$file = Input::file('file');
			if($file->isValid()){
				if(in_array($file->getMimeType(), array('application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/excel','application/x-excel','application/x-msexcel'))){
					$file_name = randomCode(Str::random(5), 15). "." . $file->getClientOriginalExtension();
					$upload = $file->move(base_path() . "/uploads/files", $file_name);
					if($upload){
						Excel::selectSheetsByIndex(0)->load($upload, function($reader) use($chapter, $upload) {
							$count = 0;
							$result = $reader->select(array('question','answer','option1','option2','option3'))->get();
							$result->each(function($row)use($chapter, $upload, $count) {
								$count=$count+1;
								if($row->question && $row->option1 && $row->option2 && $row->option3 && $row->answer){
									$question = $this -> question -> create(array('title' => $row->question,'chapter_id' => $chapter->id));
									$option_one = $question->options()->create(array('title' => $row->option1));
									$option_two = $question->options()->create(array('title' => $row->option2));
									$option_three = $question->options()->create(array('title' => $row->option3));
									$answer = $question->options()->create(array('title' => $row->answer, 'is_answer' => true));
								}else{
									if(File::exists($upload)){
										File::delete($upload);
									}
									return Redirect::back() -> withErrors(array("There was a problem in the row: <b>" . $count . "</b>"))->withInput();
								}
							});
						});
					}

					if(File::exists($upload)){
						File::delete($upload);
					}
					return Redirect::to(URL::route('management.courses.subjects.chapters.questions.import', array($course->id, $subject->id, $chapter->id)));
				}else{
					if(File::exists($upload)){
						File::delete($upload);
					}
					return Redirect::back() -> withErrors(array("Invalid file type!"))->withInput();
				}
			}
		}
	}

}