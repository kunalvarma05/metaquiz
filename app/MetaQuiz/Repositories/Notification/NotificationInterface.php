<?php
namespace MetaQuiz\Repositories\Notification;

interface NotificationInterface {

	/**
	 * all Fetch all the Notifications
	 * @param  array $with Related Models for Eager Loading
	 * @return Object The Notification Collection
	 */
	public function all($with = array());

	/**
	 * byID Find Notification by ID
	 * @param  Integer $id   The ID of the Notification
	 * @param  array  $with Related Models for Eager Loading
	 * @return Object The Notification Collection
	 */
	public function byID($id, $with = array());

	/**
	 * requireByID Get a single Notification by ID and show if not found
	 * @param Integer ID of the Notification
	 * @param Array $with [Related Models for Eager Loading]
	 * @return Object Notification Collection
	 */
	public function requireByID($id, $with = array());


	/**
	 * create Create a Notification
	 * @param Array $input Input Data to be stored
	 * @return The Newly created Notification Model Instance
	 */
	public function create(array $input);

}
