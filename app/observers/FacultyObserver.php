<?php

class FacultyObserver {

	public function creating( $faculty ) {

	}

	public function created( $faculty ) {

	}

	public function updating( $faculty ) {

	}

	public function updated( $faculty ) {

	}

	public function saving( $faculty ) {

	}

	public function saved( $faculty ) {
		Cache::forget(md5("faculties.all"));
	}

	public function deleting( $faculty ) {

	}

	public function deleted( $faculty ) {
		Cache::forget(md5("faculties.all"));
	}

}
