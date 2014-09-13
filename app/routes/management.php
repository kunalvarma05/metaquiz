<?php
/**
 * Management Routes
 */
Route::group(array('prefix' => "management", 'before' => "auth|manager_role|has-password|activated"), function() {
	/**
	 * The Index Page
	 */
	Route::get('/', array('as' => "management", 'uses' => "ManagementController@index"));

	/**
	 * The Dashboard
	 */
	Route::get('dashboard', array('as' => "management.dashboard", 'uses' => "ManagementController@dashboard"));

	/**
	 * Organization Courses
	 */
	Route::resource('courses', "ManagementCoursesController");

	/**
	 * Organization Course Subjects
	 */
	Route::resource('courses.subjects', "ManagementSubjectsController");

	/**
	 * Organization Course Subject Chapters
	 */
	Route::resource('courses.subjects.chapters', "ManagementChaptersController");

	/**
	 * Post Import Questions Route
	 */
	Route::post('courses/{course_id}/subjects/{subject_id}/chapters/{chapter_id}/questions/importer', array("as" => 'management.courses.subjects.chapters.questions.do-import', "uses" => "ManagementQuestionsController@importPost"));

	/**
	 * Import Questions Route
	 */
	Route::get('courses/{course_id}/subjects/{subject_id}/chapters/{chapter_id}/questions/import', array("as" => 'management.courses.subjects.chapters.questions.import', "uses" => "ManagementQuestionsController@import"));

	/**
	 * Organization Course Subject Chapters Questions
	 */
	Route::resource('courses.subjects.chapters.questions', "ManagementQuestionsController");

	/**
	 * Organization Faculties
	 */
	Route::resource('faculties', "ManagementFacultiesController");

	/**
	 * Organization Students
	 */
	Route::resource('students', "ManagementStudentsController");
});
