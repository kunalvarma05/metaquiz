<?php namespace MetaQuiz\Events;

use MetaQuiz\Events\Challenge\ChallengeEventHandler;
use MetaQuiz\Events\User\UserEventHandler;
use MetaQuiz\Events\Faculty\FacultyEventHandler;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider {

  /**
   * Register
   */
  public function register()
  {
  	//The UserEventSubscriber
  	$this->app->events->subscribe(new UserEventHandler);

  	//The FacultyEventSubscriber
  	$this->app->events->subscribe(new FacultyEventHandler);

    //The ChallengeEventSubscriber
    $this->app->events->subscribe(new ChallengeEventHandler);
  }

}