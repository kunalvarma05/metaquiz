<?php

/* ===========================================================================
 *  Macros
 * ===========================================================================
 */

/**
 * Tests a route against the current URL for active state
 * If true, returns 'selected' for class name
 * Usage: HTML::activeState('named.route')
 */
HTML::macro('activeState', function($route) {
	return strpos(Request::url(), route($route)) !== false ? 'active' : '';
});

/* ===========================================================================
 *  Functions
 * ===========================================================================
 */

/**
 * bodyClass
 * @return String
 */
function bodyClass() {
	$class = "";
	if (Auth::guest()) {
		$class = "splash";
	}
	return $class;
}

/**
 * arrToObj
 * @param $array Array
 * @return Object
 */
function arrToObj($array = array()) {
	return (object)$array;
}

/**
 * uploadPath
 * @param $directory String
 * @return $path String
 */
function uploadPath($directory = 'picture') {
	$uploadDir = base_path() . "/uploads/";
	switch ($directory) {
		case 'picture' :
			return $uploadDir . "pictures/";
			break;
		case 'attachment' :
			return $uploadDir . "attachments/";
			break;
		default :
			return $uploadDir . "pictures/";
			break;
	}
}

/**
 * uploadProfilePic
 * @param $image String
 * @param $title String
 * @return $title String
 */
function uploadProfilePic($image, $title) {
	$fname = "";
	if (is_null($title)) {
		$fname = Str::random(10) . time() . ".jpg";
	} else {
		$fname = $title . ".jpg";
	}
	$picture = file_get_contents($image);
	$file = uploadPath('picture') . $fname;
	file_put_contents($file, $picture);
	return $fname;
}

/**
 * profilePic
 * @param $pic String
 * @return $url String
 */
function profilePic($pic = null) {
	$storagePath = "/assets/pictures/";
	if (is_null($pic) || empty($pic)) {
		return url('/') . $storagePath . Config::get('user.defaultPicture');
	} else {
		return url('/') . $storagePath . $pic;
	}
}

/**
 * uploadImage
 * @param $image (object)
 */

function uploadImage($image, $title = null) {
	$fname = "";
	if (is_null($title)) {
		$fname = Str::random(10) . time() . ".jpg";
	} else {
		$fname = $title . ".jpg";
	}
	$image -> move(upload_url('picture'), $fname);
	return $fname;
}

/**
 * User Rank
 * @param $rank (int)
 */
function userRank($rank) {

}