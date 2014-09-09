<?php

Route::get('test', function(){
// since we connect to default setting localhost
// and 6379 port there is no need for extra
// configuration. If not then you can specify the
// scheme, host and port to connect as an array
// to the constructor.
	Debugbar::measure('publish', function(){
		try {
			$single_server = array(
				'host'     => '127.0.0.1',
				'port'     => 6379,
				'password' => "K@NT@R@NIV@RM@7600965334"
				);

			$client = new Predis\Client($single_server);
			$pubsub = $client->pubSub();
			$client->publish("realtime", Auth::check() ? Auth::user()->id : rand(0,20));
			echo "done";
		}
		catch (Exception $e) {
			echo "Couldn't connected to Redis";
			echo $e->getMessage();
		}
	});
});
/**
 * The Base Route
 */
Route::get('/', array('uses' => "RoutesController@baseRoute", 'before' => "has-password|activated"));

/**
 * Authentication Routes
 * Routes that handle the authentication views and logic
 */
require_once app_path('routes') . "/authentication.php";

/**
 * AJAX Routes
 * Routes for the AJAX Requests
 */
require_once app_path('routes') . "/ajax.php";

/**
 * Student Application Routes
 * Routes for the Student Section
 */
require_once app_path('routes') . "/app.php";

/**
 * Admin Routes
 * Routes for the Admin Section
 */
require_once app_path('routes') . "/admin.php";

/**
 * Management Routes
 * Routes for the Management Section
 */
require_once app_path('routes') . "/management.php";

/**
 * Faculty Routes
 * Routes for the Faculty Section
 */
require_once app_path('routes') . "/faculty.php";
