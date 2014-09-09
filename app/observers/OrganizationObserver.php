<?php

class OrganizationObserver {

	public function creating( $organization ) {

	}

	public function created( $organization ) {
		
	}

	public function updating( $organization ) {
		
	}

	public function updated( $organization ) {		

	}

	public function saving( $organization ) {
		
	}

	public function saved( $organization ) {		
		Cache::forget(md5("organziations.all"));
	}

	public function deleting( $organization ) {
		
	}

	public function deleted( $organization ) {		
		Cache::forget(md5("organziations.all"));		
	}

}
