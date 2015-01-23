<?php

use MetaQuiz\Repositories\User\UserInterface;

class FriendsController extends \BaseController {

		//The User Interface Object
	private $user;

	public function __construct(UserInterface $user){
		$this->user = $user;
	}

	/**
	 * Display a listing of the friends.
	 * GET /friends
	 *
	 * @return Response
	 */
	public function index()
	{
		$friends = $this->user->getFriends(Auth::user()->id);
		$friend_requests = $this->user->getFriendRequests(Auth::user()->id);
		$user = $this->user->requireByID(Auth::user()->id);
		$pageTitle = "Friends";
		return View::make('app.friends.index', compact('friends','pageTitle','friend_requests'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /friends
	 *
	 * @return Response
	 */
	public function store()
	{
		$friend_id = Input::get("friend_id");
		$user = $this->user->requireByID(Auth::user()->id);
		$friend = $user->organization()->first()->students()->findOrFail($friend_id);
		$response = array("error" => false, "message" => "");
		if($friend){
			$user->friends()->attach($friend, array("status" => "pending"));
			$friend->friends()->attach($user, array("status" => "pending"));
			$response['message'] = "Friend added!";
		}else{
			$response['error'] = true;
			$response['message'] = "Error!";
		}
		return $response;
	}

}