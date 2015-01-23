<?php
namespace MetaQuiz\Events\Challenge;
use \Notification;

class ChallengeEventHandler {

  /**
   * When a Challenge is created
   */
  public function onCreate( $data ) {

  }

  /**
   * When someone accepts a Challenge
   */
  public function onAccept( $data ) {

  }

  /**
   * When someone rejects a Challenge
   */
  public function onReject( $data ) {

  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the Challenge Create event
    $events->listen( 'campaign.create', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onCreate' );
    //Listen to the Challenge Accept event
    $events->listen( 'campaign.accept', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onAccept' );
    //Listen to the Challenge Reject event
    $events->listen( 'campaign.reject', 'MetaQuiz\Events\Challenge\ChallengeEventHandler@onReject' );
  }

}
