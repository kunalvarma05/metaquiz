<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChallengeUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('challenge_user', function(Blueprint $table) {
			$table -> increments('id');
			$table -> integer('challenge_id') -> unsigned() -> index();
			$table -> foreign('challenge_id') -> references('id') -> on('challenges') -> onDelete('cascade');
			$table -> integer('user_id') -> unsigned() -> index();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('challenge_user');
	}

}
