<?php
/**
 * AJAX Routes
 * Routes for AJAX Requests
 */
Route::group(array('before' => 'ajax|csrf', 'prefix' => "ajax"), function() {

});
