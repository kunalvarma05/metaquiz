<?php

/**
 * Friend Requests
 */
View::composer(array('app.partials.main-navigation'), function($view){
	$friend_requests = Auth::user()->friends()->where('status','pending')->get();
	$view->with('friend_requests',$friend_requests);
});