<?php
namespace MetaQuiz\Repositories;

use \User;
use \Course;
use MetaQuiz\Repositories\User\EloquentUser;
use MetaQuiz\Repositories\Organization\EloquentOrganization;
use MetaQuiz\Repositories\Course\EloquentCourse;
use MetaQuiz\Service\Cache\AppCache;
use Illuminate\Support\ServiceProvider;

/**
 * RepositoryService Provider
 */
class RepositoryServiceProvider extends ServiceProvider {

	public function register() {
		//User Repo
		$user = $this -> app -> bind('MetaQuiz\Repositories\User\UserInterface', function($app) {
			return new EloquentUser(new \User, new AppCache($app['cache'], 10));
		});
		//Organization Repo
		$org = $this -> app -> bind('MetaQuiz\Repositories\Organization\OrganizationInterface', function($app) {
			return new EloquentOrganization(new \Organization, new \User, new AppCache($app['cache'], 10));
		});
		//Organization Repo
		$course = $this -> app -> bind('MetaQuiz\Repositories\Course\CourseInterface', function($app) {
			return new EloquentCourse(new \Course, new \User, new AppCache($app['cache'], 10));
		});
	}

}
