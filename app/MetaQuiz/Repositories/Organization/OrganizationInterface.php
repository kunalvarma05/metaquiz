<?php
namespace MetaQuiz\Repositories\Organization;

use MetaQuiz\Repositories\RepositoryInterface;

interface OrganizationInterface extends RepositoryInterface {

	/**
	 * bySlug Get a Single organization by Slug
	 * @param string $slug Slug of the organization
	 * @return Object Organization Collection
	 */
	public function bySlug($slug, $with = array());

}
