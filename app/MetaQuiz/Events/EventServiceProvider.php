<?php namespace MetaQuiz\Events;

use \App;
use Illuminate\Support\ServiceProvider;
use MetaQuiz\Events\User\UserEventHandler;
use MetaQuiz\Events\Faculty\FacultyEventHandler;
use MetaQuiz\Events\Challenge\ChallengeEventHandler;
use MetaQuiz\Events\Quiz\QuizEventHandler;

class EventServiceProvider extends ServiceProvider {

  /**
   * Boot
   */
  public function boot()
  {

  	//The UserEventSubscriber
    $this->app->events->subscribe(new UserEventHandler);

  	//The FacultyEventSubscriber
    $this->app->events->subscribe(new FacultyEventHandler);

    //The ChallengeEventSubscriber
    $this->app->events->subscribe(new ChallengeEventHandler(App::make('MetaQuiz\Repositories\Notification\NotificationInterface')));

    //The QuizEventSubscriber
    $this->app->events->subscribe(new QuizEventHandler(App::make('MetaQuiz\Repositories\Activity\ActivityInterface')));
  }

  /**
   * Register
   */
  public function register(){}

}