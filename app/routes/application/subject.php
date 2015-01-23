<?php

/**
 * Subject Routes
 */

/**
 * The Subjects Page
 */
Route::get('subjects', array('as' => "app.subjects", 'uses' => "SubjectController@index"));