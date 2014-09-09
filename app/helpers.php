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
		$class = "no-user";
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
 * @param $type String
 * @return $path String
 */
function uploadPath($type) {
	$uploadDir = base_path() . "/uploads/pictures";
	switch ($type) {
		case 'user' :
		return $uploadDir . "/" . Config::get('user.folder') . "/";
		break;
		case 'organization' :
		return $uploadDir . "/" . Config::get('organization.folder') . "/";
		break;
		default :
		return $uploadDir . "misc/";
		break;
	}
}

/**
 * uploadFacebookImage
 * @param $image String
 * @param $title String
 */
function uploadFacebookImage($image, $title=null) {
	$fname = "";
	if (is_null($title)) {
		$fname = Str::random(10) . time() . ".jpg";
	} else {
		$fname = $title . ".jpg";
	}
	$picture = file_get_contents($image);
	$file = uploadPath('user') . $fname;
	file_put_contents($file, $picture);
	return $fname;
}

/**
 * profilePic
 * @param $pic String
 * @return $url String
 */
function profilePic($pic = null) {
	$storagePath = "/assets/pictures/" . Config::get('user.folder') . "/";
	if (is_null($pic) || empty($pic)) {
		return url('/') . $storagePath . Config::get('user.defaultPicture');
	} else {
		return url('/') . $storagePath . $pic;
	}
}

/**
 * orgPic
 * @param $pic String
 * @return $url String
 */
function orgPic($pic = null) {
	$storagePath = "/assets/pictures/" . Config::get('organization.folder') . "/";
	if (is_null($pic) || empty($pic)) {
		return url('/') . $storagePath . Config::get('organization.defaultPicture');
	} else {
		return url('/') . $storagePath . $pic;
	}
}

/**
 * uploadProfilePic
 * @param $image (object)
 * @param $title (string) optional
 */

function uploadProfilePic($image, $type, $title = null) {
	if ($image -> isValid()) {
		$fname = "";
		if (is_null($title)) {
			$fname = Str::random(10) . time() . ".jpg";
		} else {
			$fname = $title . ".jpg";
		}
		$image -> move(uploadPath($type), $fname);
		return $fname;
	}
}

function deleteProfilePic($image, $type){
	if(!is_null($image)) {
		$file = uploadPath($type) . $image;
		if(File::exists($file)){
			return File::delete($file);
		}
	}
}

/**
 * Generate a random code
 * @param  string $key Key to Hash
 * @return String  The obfuscated hashed key
 */
function randomCode($key, $length = 8){
	return substr(md5(microtime().rand().$key), 0, $length);
}