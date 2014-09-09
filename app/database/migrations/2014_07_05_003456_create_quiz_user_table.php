<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('quiz_user', function(Blueprint $table) {
			$table -> increments('id');
			$table -> integer('quiz_id') -> unsigned() -> index();
			$table -> foreign('quiz_id') -> references('id') -> on('quizes') -> onDelete('cascade');
			$table -> integer('user_id') -> unsigned() -> index();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> boolean('is_challenger') -> nullable();
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('quiz_user');
	}

}
