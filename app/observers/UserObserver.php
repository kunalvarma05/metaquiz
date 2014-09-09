<?php

class UserObserver {

	public function creating( $user ) {

	}

	public function created( $user ) {

	}

	public function updating( $user ) {

	}

	public function updated( $user ) {

	}

	public function saving( $user ) {

	}

	public function saved( $user ) {
		Cache::forget(md5("users.all"));
	}

	public function deleting( $user ) {

	}

	public function deleted( $user ) {
		Cache::forget(md5("users.all"));
	}

}
