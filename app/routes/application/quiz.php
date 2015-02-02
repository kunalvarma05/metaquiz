<?php

/**
 * Quiz Routes
 */


/**
 * Quiz List Page
 */
Route::get('quiz', array('as' => "app.quizzes", 'uses' => "QuizController@index"));


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

/**
 * Quiz No Answer Choosen
 */
Route::any('quiz/no-answer-chosen', array('as' => "app.quiz.noAnswerChosen", 'uses' => "QuizController@noAnswerChosen"));

/**
 * Quiz Result
 */
Route::get('quiz/{quiz_id}/results', array('as' => "app.quiz.results", 'uses' => "QuizController@result"));