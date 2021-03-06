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
		$questions = $chapter->questions()->simplePaginate(20);
		$pageTitle = $subject->name . " - Questions";
		if($questions->getCurrentPage() === 1 || !$questions->isEmpty()){
			return View::make('backend.questions.index', compact('pageTitle','organization','course','subject','chapter','questions'));
		}else{
			App::abort(404);
		}
	}


	public function create($course_id, $subject_id, $chapter_id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$pageTitle = $subject->name . " | Add Question";
		return View::make('backend.questions.create', compact('pageTitle','organization','course','subject', 'chapter'));
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
		return View::make('backend.questions.show', compact('pageTitle','organization','course','subject','chapter', 'question'));
	}


	public function edit($course_id, $subject_id, $chapter_id, $id)
	{
		$organization_id = Auth::user()->organization_id;
		$organization = $this->org->requireByID($organization_id);
		$course = $organization->courses()->findOrFail($course_id);
		$subject = $course->subjects()->findOrFail($subject_id);
		$chapter = $subject->chapters()->findOrFail($chapter_id);
		$question = $chapter->questions()->findOrFail($id);

		$option_one = $question->options()->where('is_answer', NULL)->first();
		$option_two = $question->options()->where('id', '>', $option_one->id)->where('is_answer', NULL)->first();
		$option_three = $question->options()->where('id', '>', $option_two->id)->where('is_answer', NULL)->first();
		$answer = $question->options()->where('is_answer', 1)->first();

		$pageTitle = "Edit " . $question->title;
		return View::make('backend.questions.edit', compact('pageTitle','organization','course','subject','chapter','question', 'option_one', 'option_two', 'option_three', 'answer'));
	}


	public function update($course_id, $subject_id, $chapter_id, $id)
	{
		$input = Input::only(array('title', 'option_one', 'option_two', 'option_three', 'answer'));
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
		$delete = $question->delete();
		if($delete){
			return Redirect::to(URL::route('management.courses.subjects.questions.index', array($course->id, $subject->id)));
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
		return View::make('backend.questions.import', compact('pageTitle','organization','course','subject','chapter'));
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
		//Is the file uploaded
		if (Input::hasFile('file')) {
			//The file
			$file = Input::file('file');
				//Check if the file type is allowed or not
			if(in_array($file->getMimeType(), Config::get('metaquiz.allowedDocumentType'))){
					//File name
				$file_name = randomCode(Str::random(5), 15). "." . $file->getClientOriginalExtension();
					//Upload the file
				$upload = $file->move(base_path() . "/uploads/files", $file_name);
					//If the file was uploaded
				if($upload){
						//Extract questions, options and answer
					Excel::selectSheetsByIndex(0)->load($upload, function($reader) use($chapter, $upload) {
							//Init row count
						$count = 0;
							//Fetch the result
						$result = $reader->select(array('question','answer','option1','option2','option3'))->get();
							//Interate on the result row by row
						$result->each(function($row)use($chapter, $upload, $count) {
								//Increament the counter
							$count=$count+1;
								//If all the details are present in the row
							if($row->question && $row->option1 && $row->option2 && $row->option3 && $row->answer){
									//The question
								$question = $this -> question -> create(array('title' => $row->question,'chapter_id' => $chapter->id));
									//The options
								$option_one = $question->options()->create(array('title' => $row->option1));
								$option_two = $question->options()->create(array('title' => $row->option2));
								$option_three = $question->options()->create(array('title' => $row->option3));
									//The answer
								$answer = $question->options()->create(array('title' => $row->answer, 'is_answer' => true));
							}else{
									//The row had an error
									//Delete the uploaded file
								if(File::exists($upload)){
									File::delete($upload);
								}
									//Get back to the user with the errored row
								return Redirect::back() -> withErrors(array("There was a problem in the row: <b>" . $count . "</b>"))->withInput();
							}
						});
});
						//The upload was successful
						//We can now delete the uploaded file
if(File::exists($upload)){
	File::delete($upload);
}
											//And go to the added questions page
return Redirect::to(URL::route('management.courses.subjects.chapters.questions.index', array($course->id, $subject->id, $chapter->id)));
}
else{
						//There was a problem in uploading the file
	return Redirect::back() -> withErrors(array("There was an error while uploading your file. Please try again!"))->withInput();
}
}else{
					//Invalid file type
	return Redirect::back() -> withErrors(array("Invalid file type!"))->withInput();
}
}else{
			//No file was uploaded
	return Redirect::back() -> withErrors(array("Please upload a file!"))->withInput();
}
}
}