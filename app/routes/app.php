<?php

Route::group(array('prefix' => "app", 'before' => "auth|student_role|has-password|activated"), function() {
	/**
	 * The Index Page
	 */
	Route::get('/', array('as' => 'app', 'uses' => "ApplicationsController@index"));

	/**
	 * The Home Page
	 */
	Route::get('home', array('as' => "app.home", 'uses' => "ApplicationsController@home"));

	/**
	 * The Subjects Page
	 */
	Route::get('subjects', array('as' => "app.subjects", 'uses' => "ApplicationsController@subjects"));

	/**
	 * The Friends Page
	 */
	Route::get('friends', array('as' => "app.friends", 'uses' => "ApplicationsController@friends"));

	/**
	 * New Quiz Page
	 */
	Route::get('quiz/new/course/{course_id}/subject/{subject_id}', array('as' => "app.quiz.create", 'uses' => "QuizController@create"));

	/**
	 * Generate Quiz
	 */
	Route::post('quiz/generate', array('as' => "app.quiz.generate", 'uses' => "QuizController@generate"));

	/**
	 * The Quiz Page
	 */
	Route::get('quiz/play/{quiz_id}',array('as' => "app.quiz.play", 'uses' => "QuizController@play") );

	/**
	 * Unanswered Asked Questions
	 */
	Route::any('quiz/questions', array('as' => "app.quiz.getQuestions", 'uses' => "QuizController@getQuestion"));

	/**
	 * Quiz Check Answer
	 */
	Route::any('quiz/check/answer', array('as' => "app.quiz.checkAnswer", 'uses' => "QuizController@checkAnswer"));

});