<?php
namespace MetaQuiz\Service\Form;

use Illuminate\Support\ServiceProvider;
use MetaQuiz\Service\Form\User\CreateUserForm;
use MetaQuiz\Service\Form\User\CreateUserFormValidator;
use MetaQuiz\Service\Form\Activate\ActivateForm;
use MetaQuiz\Service\Form\Activate\ActivateUserFormValidator;
use MetaQuiz\Service\Form\Organization\CreateOrganizationForm;
use MetaQuiz\Service\Form\Organization\CreateOrganizationFormValidator;
use MetaQuiz\Service\Form\Organization\UpdateOrganizationForm;
use MetaQuiz\Service\Form\Organization\UpdateOrganizationFormValidator;
use MetaQuiz\Service\Form\Course\CreateCourseForm;
use MetaQuiz\Service\Form\Course\CreateCourseFormValidator;
use MetaQuiz\Service\Form\Course\UpdateCourseForm;
use MetaQuiz\Service\Form\Course\UpdateCourseFormValidator;

class FormServiceProvider extends ServiceProvider {

	/**
	 * Registering the binding
	 * @return void
	 */
	public function register() {
		//UserForm
		$this -> app -> bind('MetaQuiz/Service/Form/User/CreateUserForm', function($app) {
			return new CreateUserForm(new CreateUserFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\User\UserInterface'));
		});
		//ActivateForm
		$this -> app -> bind('MetaQuiz/Service/Form/Activate/ActivateForm', function($app) {
			return new ActivateForm(new ActivateFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\User\UserInterface'));
		});
		//CreateOrganizationForm
		$this -> app -> bind('MetaQuiz/Service/Form/Organization/CreateOrganizationForm', function($app) {
			return new CreateOrganizationForm(new CreateOrganizationFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Organization\OrganizationInterface'));
		});
		//UpdateOrganizationForm
		$this -> app -> bind('MetaQuiz/Service/Form/Organization/UpdateOrganizationForm', function($app) {
			return new UpdateOrganizationForm(new UpdateOrganizationFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Organization\OrganizationInterface'));
		});
		//CreateCourseForm
		$this -> app -> bind('MetaQuiz/Service/Form/Course/CreateCourseForm', function($app) {
			return new CreateCourseForm(new CreateCourseFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Course\CourseInterface'));
		});
		//UpdateCourseForm
		$this -> app -> bind('MetaQuiz/Service/Form/Course/UpdateCourseForm', function($app) {
			return new UpdateCourseForm(new UpdateCourseFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Course\CourseInterface'));
		});
		//CreateSubjectForm
		$this -> app -> bind('MetaQuiz/Service/Form/Subject/CreateSubjectForm', function($app) {
			return new CreateSubjectForm(new CreateSubjectFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Subject\SubjectInterface'));
		});
		//UpdateSubjectForm
		$this -> app -> bind('MetaQuiz/Service/Form/Subject/UpdateSubjectForm', function($app) {
			return new UpdateSubjectForm(new UpdateSubjectFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Subject\SubjectInterface'));
		});
		//CreateChapterForm
		$this -> app -> bind('MetaQuiz/Service/Form/Chapter/CreateChapterForm', function($app) {
			return new CreateChapterForm(new CreateChapterFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Chapter\ChapterInterface'));
		});
		//UpdateChapterForm
		$this -> app -> bind('MetaQuiz/Service/Form/Chapter/UpdateChapterForm', function($app) {
			return new UpdateChapterForm(new UpdateChapterFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Chapter\ChapterInterface'));
		});
		//CreateQuestionForm
		$this -> app -> bind('MetaQuiz/Service/Form/Question/CreateQuestionForm', function($app) {
			return new CreateQuestionForm(new CreateQuestionFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Question\QuestionInterface'));
		});
		//UpdateQuestionForm
		$this -> app -> bind('MetaQuiz/Service/Form/Question/UpdateQuestionForm', function($app) {
			return new UpdateQuestionForm(new UpdateQuestionFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Question\QuestionInterface'));
		});
		//CreateFacultyForm
		$this -> app -> bind('MetaQuiz/Service/Form/Faculty/CreateFacultyForm', function($app) {
			return new CreateFacultyForm(new CreateFacultyFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Faculty\FacultyInterface'));
		});
		//UpdateFacultyForm
		$this -> app -> bind('MetaQuiz/Service/Form/Faculty/UpdateFacultyForm', function($app) {
			return new UpdateFacultyForm(new UpdateFacultyFormValidator($app['validator']), $app -> make('MetaQuiz\Repo\Faculty\FacultyInterface'));
		});
	}

}
