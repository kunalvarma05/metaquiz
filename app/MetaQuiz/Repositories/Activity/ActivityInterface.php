<?php
namespace MetaQuiz\Repositories\Activity;

use MetaQuiz\Repositories\RepositoryInterface;

interface ActivityInterface extends RepositoryInterface{

	/**
	 * The WhereIn Database Builder Method
	 * @param  String $field   Field to Query
	 * @param  Closure $closure
	 */
	public function whereIn($field, $closure);

}
