<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('teachers', function(Blueprint $table) {
			$table -> increments('id');
			$table -> string('gr_no') -> nullable();
			$table -> integer('user_id') -> unsigned() -> nullable();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('teachers');
	}

}
