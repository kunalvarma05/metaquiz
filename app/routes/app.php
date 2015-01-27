<?php

//Application Routes
Route::group(array('prefix' => "app", 'before' => "auth|student_role|has-password|activated"), function() {

	//Notification Routes
	require_once('application/notification.php');

	//Dashboard Routes
	require_once('application/dashboard.php');

	//Subject Routes
	require_once('application/subject.php');

	//Friend Routes
	require_once('application/friend.php');

	//Quiz Routes
	require_once('application/quiz.php');

	//Challenge Routes
	require_once('application/challenge.php');


});