<?php

class SubjectObserver {

	public function creating( $subject ) {

	}

	public function created( $subject ) {

	}

	public function updating( $subject ) {

	}

	public function updated( $subject ) {

	}

	public function saving( $subject ) {

	}

	public function saved( $subject ) {
		Cache::forget(md5("subjects.all"));
	}

	public function deleting( $subject ) {

	}

	public function deleted( $subject ) {
		Cache::forget(md5("subjects.all"));
	}

}
