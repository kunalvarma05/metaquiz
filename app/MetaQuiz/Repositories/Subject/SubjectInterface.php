<?php
namespace MetaQuiz\Repositories\Subject;

use MetaQuiz\Repositories\RepositoryInterface;

interface SubjectInterface extends RepositoryInterface{

	/**
	 * bySlug Get a Single Subject by Slug
	 * @param string $slug Slug of the Subject
	 * @return Object Subject Collection
	 */
	public function bySlug($slug, $with = array());

}
