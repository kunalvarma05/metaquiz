<?php
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
