<?php namespace MetaQuiz\Events\Challenge;

use MetaQuiz\Repositories\Notification\NotificationInterface;

class ChallengeEventHandler {

  /**
   * The Notification Object
   * @var NotificationInterface
   */
  private $notification;

  /**
   * The Constructor
   * @param NotificationInterface $notification
   */
  public function __construct(NotificationInterface $notification){
    $this->notification = $notification;
  }

  /**
   * When a Challenge is created
   */
  public function onCreate( $data ) {
    $data['targetable_id'] = $data['challenge_id'];
    $data['targetable_type'] = 'Challenge';
    //Create the notification
    $notification = $this->notification->create($data);
  }

  /**
   * When someone accepts a Challenge
   */
  public function onAccept( $data ) {
    $data['targetable_id'] = $data['challenge_id'];
    $data['targetable_type'] = 'Challenge';
    //Create the notification
    $notification = $this->notification->create($data);
  }

  /**
   * When someone rejects a Challenge
   */
  public function onReject( $data ) {
    $data['targetable_id'] = $data['challenge_id'];
    $data['targetable_type'] = 'Challenge';
    //Create the notification
    $notification = $this->notification->create($data);
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the Challenge Create event
    $events->listen( 'challenge.create', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onCreate' );
    //Listen to the Challenge Accept event
    $events->listen( 'challenge.accept', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onAccept' );
    //Listen to the Challenge Reject event
    $events->listen( 'challenge.reject', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onReject' );
  }

}
