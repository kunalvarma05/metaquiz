<?php

class CourseObserver {

	public function creating( $course ) {

	}

	public function created( $course ) {

	}

	public function updating( $course ) {

	}

	public function updated( $course ) {

	}

	public function saving( $course ) {

	}

	public function saved( $course ) {
		Cache::forget(md5("courses.all"));
	}

	public function deleting( $course ) {

	}

	public function deleted( $course ) {
		Cache::forget(md5("courses.all"));
	}

}
