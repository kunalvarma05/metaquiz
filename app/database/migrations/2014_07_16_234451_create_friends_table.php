<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('friends', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('friend_one') -> unsigned();
			$table -> foreign('friend_one') -> references('id') -> on('users');
			$table -> integer('friend_two') -> unsigned();
			$table -> foreign('friend_two') -> references('id') -> on('users');
			$table -> string('status');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('friends');
	}

}
