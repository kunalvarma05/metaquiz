<?php
namespace MetaQuiz\Events\Student;
use \Mail;

class StudentEventHandler {

  /**
   * When a Student is invited
   */
  public function onInvite( $data ) {

  }

  /**
   * When a Student joins
   */
  public function onJoin( $data ) {

  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the Student Create event
    $events->listen( 'student.invite', 'MetaQuiz\Events\Student\StudentEventHandler@onInvite' );
    //Listen to the Student Update event
    $events->listen( 'student.join', 'MetaQuiz\Events\Student\StudentEventHandler@onJoin' );
  }

}
