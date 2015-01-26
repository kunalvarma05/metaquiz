<?php
namespace MetaQuiz\Repositories\Student;

use MetaQuiz\Repositories\RepositoryInterface;

interface StudentInterface extends RepositoryInterface{

	/**
	 * byGrNo Get a Single Student by GrNo
	 * @param string $GrNo GrNo of the Student
	 * @return Object Student Collection
	 */
	public function byGrNo($GrNo, $with = array());

}
