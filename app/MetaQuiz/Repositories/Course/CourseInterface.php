<?php
namespace MetaQuiz\Repositories\Course;

use MetaQuiz\Repositories\RepositoryInterface;

interface CourseInterface extends RepositoryInterface{

	/**
	 * bySlug Get a Single Course by Slug
	 * @param string $slug Slug of the Course
	 * @return Object Course Collection
	 */
	public function bySlug($slug, $with = array());

}
