<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('notifications', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('message');
			$table -> integer('user_id') -> unsigned() -> index();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> integer('targetable_id') -> unsigned();
			$table -> string('targetable_type');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('notifications');
	}

}
