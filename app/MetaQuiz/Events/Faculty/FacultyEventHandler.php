<?php
namespace MetaQuiz\Events\Faculty;
use \Mail;

class FacultyEventHandler {

  /**
   * When a Faculty is invited
   */
  public function onInvite( $data ) {
    Mail::send('emails.faculty.invite', $data, function($message) use($data) {
      $message->to($data['email'], $data['name'])->subject($data['organization'] . " on MetaQuiz.");
    });
  }

  /**
   * When a Faculty joins
   */
  public function onJoin( $data ) {
    Mail::send('emails.faculty.join', $data, function($message) use($data) {
      $message->to($data['email'], $data['name'])->subject($data['faculty'] . " joined " . $data['organization']);
    });
  }

  /**
   * Register the listeners for the subscriber.
   *
   * @param Illuminate\Events\Dispatcher $events
   * @return array
   */
  public function subscribe( $events ) {
    //Listen to the Faculty Create event
    $events->listen( 'faculty.invite', 'MetaQuiz\Events\Faculty\FacultyEventHandler@onInvite' );
    //Listen to the Faculty Update event
    $events->listen( 'faculty.join', 'MetaQuiz\Events\Faculty\FacultyEventHandler@onJoin' );
  }

}
