<?php

/**
 * Activity
 * Views: Activity, Sidebar
 */
View::composer(array('app.home.activity', 'app.partials.sidebar'), function($view) {
	$id = Auth::user() -> id . '-activities';
	if (Cache::has($id)) {
		$activities = Cache::get($id);
	} else {
		$friend_ids = array_fetch(Auth::user() -> friends() -> get() -> toArray(), 'friend_two');
		$users = array_flatten(array_add($friend_ids, "", Auth::user() -> id));
		$activities = Notification::with('user', 'targetable') -> whereIn("user_id", $users) -> get();
		Cache::put($id, $activities, 60);
	}
	$view -> with('activities', $activities);
});

/**
 * Friend Request Count
 */
View::composer(array('app.partials.main-navigation'), function($view) {
	$requests = Friend::where('friend_two', '=', Auth::user() -> id) -> where('status', '=', 0) -> get();
	$view -> with('friend_requests', $requests);
});

/**
 * Courses
 */
View::composer("app.subjects.index", function($view) {
	$org = Auth::user() -> organization;
	$courses = Course::with('subjects', 'subjects.chapters') -> where('organization_id', '=', $org -> id) -> get();
	$view -> with('courses', $courses);
});
