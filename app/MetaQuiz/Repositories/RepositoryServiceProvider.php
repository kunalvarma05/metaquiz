<?php
namespace MetaQuiz\Repositories;

use \User;
use \Activation;
use MetaQuiz\Service\Cache\AppCache;
use Illuminate\Support\ServiceProvider;
use MetaQuiz\Repositories\User\EloquentUser;
use MetaQuiz\Repositories\Course\EloquentCourse;
use MetaQuiz\Repositories\Subject\EloquentSubject;
use MetaQuiz\Repositories\Chapter\EloquentChapter;
use MetaQuiz\Repositories\Faculty\EloquentFaculty;
use MetaQuiz\Repositories\Student\EloquentStudent;
use MetaQuiz\Repositories\Question\EloquentQuestion;
use MetaQuiz\Repositories\Activity\EloquentActivity;
use MetaQuiz\Repositories\Activation\EloquentActivation;
use MetaQuiz\Repositories\Organization\EloquentOrganization;
use MetaQuiz\Repositories\Challenge\EloquentChallenge;
use MetaQuiz\Repositories\ChallengeRequest\EloquentChallengeRequest;
use MetaQuiz\Repositories\Notification\EloquentNotification;

/**
 * RepositoryService Provider
 */
class RepositoryServiceProvider extends ServiceProvider {

	public function register() {
		/**
		 * User Repo
		 *
		 * UserInterface
		 * - User
		 * - AppCache
		 */
		$user = $this -> app -> bind('MetaQuiz\Repositories\User\UserInterface', function($app) {
			return new EloquentUser(new \User, $this->app->make('MetaQuiz\Repositories\Activity\ActivityInterface'), new AppCache($app['cache'], 60));
		});

		/**
		 * Activation Repo
		 *
		 * ActivationInterface
		 * - Activation
		 * - UserInterface
		 * - AppCache
		 */
		$activation = $this -> app -> bind('MetaQuiz\Repositories\Activation\ActivationInterface', function($app) {
			return new EloquentActivation(new \Activation, $app -> make('MetaQuiz\Repositories\User\UserInterface'), new AppCache($app['cache'], 60));
		});

		/**
		 * Organization Repo
		 *
		 * OrganizationInterface
		 * - Organization
		 * - AppCache
		 */
		$organization = $this -> app -> bind('MetaQuiz\Repositories\Organization\OrganizationInterface', function($app) {
			return new EloquentOrganization(new \Organization, new AppCache($app['cache'], 60));
		});

		/**
		 * Course Repo
		 *
		 * CourseInterface
		 * - Course
		 * - AppCache
		 */
		$course = $this -> app -> bind('MetaQuiz\Repositories\Course\CourseInterface', function($app) {
			return new EloquentCourse(new \Course, new AppCache($app['cache'], 60));
		});

		/**
		 * Subject Repo
		 *
		 * SubjectInterface
		 * - Subject
		 * - AppCache
		 */
		$subject = $this -> app -> bind('MetaQuiz\Repositories\Subject\SubjectInterface', function($app) {
			return new EloquentSubject(new \Subject, new AppCache($app['cache'], 60));
		});


		/**
		 * Chapter Repo
		 *
		 * ChapterInterface
		 * - Chapter
		 * - AppCache
		 */
		$chapter = $this -> app -> bind('MetaQuiz\Repositories\Chapter\ChapterInterface', function($app) {
			return new EloquentChapter(new \Chapter, new AppCache($app['cache'], 60));
		});

		/**
		 * Question Repo
		 *
		 * QuestionInterface
		 * - Question
		 * - AppCache
		 */
		$question = $this -> app -> bind('MetaQuiz\Repositories\Question\QuestionInterface', function($app) {
			return new EloquentQuestion(new \Question, new AppCache($app['cache'], 60));
		});

		/**
		 * Faculty Repo
		 *
		 * FacultyInterface
		 * - Faculty
		 * - AppCache
		 */
		$faculty = $this -> app -> bind('MetaQuiz\Repositories\Faculty\FacultyInterface', function($app) {
			return new EloquentFaculty(new \Faculty, new AppCache($app['cache'], 60));
		});

		/**
		 * Student Repo
		 *
		 * StudentInterface
		 * - Student
		 * - AppCache
		 */
		$student = $this -> app -> bind('MetaQuiz\Repositories\Student\StudentInterface', function($app) {
			return new EloquentStudent(new \Student, new AppCache($app['cache'], 60));
		});

		/**
		 * Activity Repo
		 *
		 * ActivityInterface
		 * - Activity
		 * - AppCache
		 */
		$activity = $this -> app -> bind('MetaQuiz\Repositories\Activity\ActivityInterface', function($app) {
			return new EloquentActivity(new \Activity, new AppCache($app['cache'], 60));
		});

		/**
		 * Challenge Repo
		 *
		 * ChallengeInterface
		 * - Challenge
		 * - AppCache
		 */
		$challenge = $this -> app -> bind('MetaQuiz\Repositories\Challenge\ChallengeInterface', function($app) {
			return new EloquentChallenge(new \Challenge, new AppCache($app['cache'], 60));
		});

		/**
		 * ChallengeRequest Repo
		 *
		 * ChallengeRequestInterface
		 * - ChallengeRequest
		 * - AppCache
		 */
		$challengeRequest = $this -> app -> bind('MetaQuiz\Repositories\ChallengeRequest\ChallengeRequestInterface', function($app) {
			return new EloquentChallengeRequest(new \ChallengeRequest, new AppCache($app['cache'], 60));
		});

		/**
		 * Notification Repo
		 *
		 * NotificationInterface
		 * - Notification
		 * - AppCache
		 */
		$notification = $this -> app -> bind('MetaQuiz\Repositories\Notification\NotificationInterface', function($app) {
			return new EloquentNotification(new \Notification, new AppCache($app['cache'], 60));
		});
	}
}
