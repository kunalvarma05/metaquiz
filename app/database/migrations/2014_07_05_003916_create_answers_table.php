<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('answers', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('quiz_id') -> unsigned() -> index();
			$table -> foreign('quiz_id') -> references('id') -> on('quizes') -> onDelete('cascade');
			$table -> integer('question_quiz_id') -> unsigned() -> index();
			$table -> foreign('question_quiz_id') -> references('id') -> on('question_quiz') -> onDelete('cascade');
			$table -> integer('user_id') -> unsigned() -> index();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> integer('option_id') -> unsigned() -> index();
			$table -> foreign('option_id') -> references('id') -> on('options') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('answers');
	}

}
