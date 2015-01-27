<?php
namespace MetaQuiz\Service\Process;

use Illuminate\Support\ServiceProvider;

/**
 * ProcessService Provider
 */
class ProcessServiceProvider extends ServiceProvider {

	public function register() {
		/**
		 * QuizProcess
		 */
		$quizProcess = $this -> app -> bind('MetaQuiz\Service\Process\Quiz\QuizProcessInterface', function($app) {
			return $this->app->make('MetaQuiz\Service\Process\Quiz\QuizProcess');
		});
	}

}