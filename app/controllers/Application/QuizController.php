<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Repositories\Course\CourseInterface;
use MetaQuiz\Repositories\Subject\SubjectInterface;

class QuizController extends \BaseController {

	//The User Interface Object
	private $user;

	//The Organization Interface Object
	private $organization;

	//The Course Interface Object
	private $course;

	//The Subject Interface Object
	private $subject;

	public function __construct(UserInterface $user, OrganizationInterface $organization, CourseInterface $course, SubjectInterface $subject){
		$this->user = $user;
		$this->organization = $organization;
		$this->course = $course;
		$this->subject = $subject;
	}

	/**
	 * Display a listing of the resource.
	 * GET /application/quiz
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /application/quiz/create
	 *
	 * @return Response
	 */
	public function create($course_id, $subject_id)
	{
		//Get the logged in user
		$user = Auth::user();

		//Get the Organization of the logged in user
		$organization_id = $user->organization_id;
		$organization = $this->organization->requireByID($organization_id);

		//Find the course
		$course = $organization->courses()->findOrFail($course_id);

		//Find the subject
		$subject = $course->subjects()->findOrFail($subject_id);

		//Chapters
		$chapters = array();
		foreach ($subject->chapters as $chapter) {
			$chapters[$chapter->id] = $chapter->name;
		}

		//Page Title
		$pageTitle = "Start a New Quiz";

		//Make the response
		return View::make('app.quiz.new', compact('pageTitle', 'organization', 'course', 'subject', 'chapters'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /application/quiz
	 *
	 * @return Response
	 */
	public function generate()
	{
		//The Input
		$input = Input::only('chapters');
		//Find the current user
		$user = User::findOrFail(Auth::user()->id);
		//Create a new Quiz
		$quiz = new Quiz;
		//Set Status as Unfinished
		$quiz->status = "unfinished";
		//Associate the user with the quiz
		$quiz->user()->associate($user);
		//Save the quiz
		$quiz->save();
		//Attach the selected chapters to the quiz
		$quiz->chapters()->sync($input['chapters']);

		//Fetch 5 random questions each from the selected chapters
		$chapters = $quiz->chapters()->with(array('questions' => function($query){
			$query->orderByRaw('RAND()')->take(5)->get();
		}))->get();

		//Questions to be included in the quiz
		$questions = array();
		foreach ($chapters as $chapter) {
			foreach ($chapter->questions as $question) {
				$questions[] = $question->id;
			}
		}
		//Attach the aggregated questions to the quiz
		$quiz->questions()->sync($questions);

		//Redirect the user to the play quiz page
		return Redirect::to(URL::route('app.quiz.play', array($quiz->id)));
	}

	/**
	 * Display the specified resource.
	 * GET /application/quiz/{quiz_id}
	 *
	 * @param  int  $quiz_id
	 * @return Response
	 */
	public function play($quiz_id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /application/quiz/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /application/quiz/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /application/quiz/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}