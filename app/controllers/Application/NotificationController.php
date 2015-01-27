<?php

use MetaQuiz\Repositories\Notification\NotificationInterface;

class NotificationController extends \BaseController{

	/**
	 * NotificationInterface Object
	 * @var NotificationInterface
	 */
	private $notifier;

	/**
	 * The Constructor
	 * @param NotificationInterface $notifier
	 */
	public function __construct(NotificationInterface $notifier){
		$this->notifier = $notifier;
	}

	/**
	 * Handle a sinel notification and redirect to the correct target
	 * @param  int $id ID of the notification
	 * @return Response
	 */
	public function show($id){
		$notification = $this->notifier->requireByID($id);
		$type = strtolower($notification->targetable_type);
		$target = $notification->targetable;
		$route = "";

		//Determine the route to redirect to
		switch ($type) {
			case 'challenge':
			$route = Redirect::route('app.challenges.show', array($notification->targetable->id));
			break;
		}

		//Delete the notification
		if($notification->delete()){
			//And, redirect
			return $route;
		}else{
			App::abort(404);
		}

	}

}