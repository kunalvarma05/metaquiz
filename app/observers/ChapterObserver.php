<?php

class ChapterObserver {

	public function creating( $chapter ) {

	}

	public function created( $chapter ) {

	}

	public function updating( $chapter ) {

	}

	public function updated( $chapter ) {

	}

	public function saving( $chapter ) {

	}

	public function saved( $chapter ) {
		Cache::forget(md5("chapters.all"));
	}

	public function deleting( $chapter ) {

	}

	public function deleted( $chapter ) {
		Cache::forget(md5("chapters.all"));
	}

}
