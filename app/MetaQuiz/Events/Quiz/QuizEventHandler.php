<?php namespace MetaQuiz\Events\Quiz;

use MetaQuiz\Repositories\Activity\ActivityInterface;

class QuizEventHandler {

  /**
   * The Activity Object
   * @var ActivityInterface
   */
  private $activity;

  /**
   * The Constructor
   * @param ActivityInterface $activity
   */
  public function __construct(ActivityInterface $activity){
    $this->activity = $activity;
  }

  /**
   * When a Quiz is created
   */
  public function onPlay( $data ) {
    $data['targetable_id'] = $data['quiz_id'];
    $data['targetable_type'] = 'Quiz';
    $data['type'] = 'quiz_start';
    //Create the activity
    $activity = $this->activity->create($data);
  }

  /**
   * When someone accepts a Quiz
   */
  public function onComplete( $data ) {
    $data['targetable_id'] = $data['quiz_id'];
    $data['targetable_type'] = 'Quiz';
    $data['type'] = 'quiz_complete';
    //Create the activity
    $activity = $this->activity->create($data);
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the Quiz Create event
    $events->listen( 'quiz.play', 'MetaQuiz\Events\Quiz\QuizEventHandler@onPlay' );
    //Listen to the Quiz Complete event
    $events->listen( 'quiz.complete', 'MetaQuiz\Events\Quiz\QuizEventHandler@onComplete' );
  }

}
