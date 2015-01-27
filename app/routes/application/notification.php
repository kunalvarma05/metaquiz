<?php
/**
 * Notification Routes
 */

/**
 * Show Notification
 */
Route::get('notifications/{id}', array('as' => "app.notifications.show", 'uses' => "NotificationController@show"));