<?php
namespace MetaQuiz\Repositories\Faculty;

use MetaQuiz\Repositories\RepositoryInterface;

interface FacultyInterface extends RepositoryInterface {

	/**
	 * byGrNo Get a Single Faculty by GrNo
	 * @param string $GrNo GrNo of the Faculty
	 * @return Object Faculty Collection
	 */
	public function byGrNo($GrNo, $with = array());

}
