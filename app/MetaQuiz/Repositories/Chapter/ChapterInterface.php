<?php
namespace MetaQuiz\Repositories\Chapter;

use MetaQuiz\Repositories\RepositoryInterface;

interface ChapterInterface extends RepositoryInterface {

	/**
	 * bySlug Get a Single Chapter by Slug
	 * @param string $slug Slug of the Chapter
	 * @return Object Chapter Collection
	 */
	public function bySlug($slug, $with = array());

}
