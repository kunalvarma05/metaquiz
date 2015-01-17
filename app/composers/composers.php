<?php

/**
 * Friend Requests
 */
View::composer(array('app.partials.main-navigation'), function($view){
	$friend_requests = Auth::user()->friendRequests()->count();
	$view->with('friend_requests',$friend_requests);
});

/**
 * Friend Suggestions
 */
View::composer(array('app.partials.sidebar'), function($view){
	$id = Auth::user()->id;
	$suggestions = Auth::user()->organization()->first()->students()->whereNotIn('id', function($query) use ($id) {
		$query->select('friend_id')
		->from('friends')
		->where('user_id', $id);
	})->where('id', '<>', $id)->limit(5)->get();
	$view->with(compact('suggestions'));
});