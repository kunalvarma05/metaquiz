<?php
/**
* Challenge Routes
*/


/**
 * Create Challenge
 */
Route::post('challenge/create', array('as' => "app.quiz.create-challenge", 'uses' => "ChallengeController@create"));