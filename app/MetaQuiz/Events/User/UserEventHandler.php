<?php
namespace MetaQuiz\Events\User;
use \Mail;

class UserEventHandler {
  /**
   * When a user is created
   */
  public function onCreate( $data ) {

  }

  /**
   * When a user is updated
   */
  public function onUpdate( $data ) {
    //
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the User Create event
    $events->listen( 'user.create', 'MetaQuiz\Events\User\UserEventHandler@onCreate' );
    //Listen to the User Update event
    $events->listen( 'user.update', 'MetaQuiz\Events\User\UserEventHandler@onUpdate' );
  }

}
