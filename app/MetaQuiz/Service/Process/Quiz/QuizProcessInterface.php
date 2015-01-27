<?php namespace MetaQuiz\Service\Process\Quiz;

interface QuizProcessInterface {
	/**
	 * Generate Quiz
	 * @param  int $user_id     ID of a user
	 * @param  array  $chapter_ids ID's of chapters to be included in the quiz
	 * @return Quiz              Newly created quiz
	 */
	public function generate($user_id, $chapter_ids = array());


	/**
	 * Get the next unanswered question
	 * @param  int $user_id ID of a user
	 * @param  int $quiz_id ID of a quiz
	 * @return Question The question to be asked
	 */
	public function getNextQuestion($user_id, $quiz_id);


	/**
	 * Check the answer
	 * @param  int $user_id ID of a user
	 * @param  array  $input   An array of input values
	 * @return array          Generated response
	 */
	public function checkAnswer($user_id, $input = array());


	/**
	 * Finish the quiz
	 * @param  int $user_id ID of a user
	 * @param  int  $quiz_id ID of a quiz
	 * @return Boolean
	 */
	public function finish($user_id, $quiz_id);
}