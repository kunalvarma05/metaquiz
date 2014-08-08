<?php
namespace MetaQuiz\Service\Form;

use Illuminate\Support\ServiceProvider;
use MetaQuiz\Service\Form\UserForm;
use MetaQuiz\Service\Form\UserFormValidator;

class FormServiceProvider extends ServiceProvider {

	/**
	 * Registering the binding
	 * @return void
	 */
	public function register() {
		//UserForm
		$this -> app -> bind('MetaQuiz/Service/Form/User/UserForm', function($app) {
			return new UserForm(new UserFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\User\UserInterface'));
		});
		//ActivateForm
		$this -> app -> bind('MetaQuiz/Service/Form/Activate/ActivateForm', function($app) {
			return new ActivateForm(new ActivateFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\User\UserInterface'));
		});
		//ArticleForm
		$this -> app -> bind('MetaQuiz/Service/Form/Article/ArticleForm', function($app) {
			return new ArticleForm(new ArticleFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Article\ArticleInterface'));
		});
	}

}
