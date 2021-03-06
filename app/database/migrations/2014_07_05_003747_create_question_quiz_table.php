<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionQuizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('question_quiz', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('question_id') -> unsigned() -> index();
			$table -> foreign('question_id') -> references('id') -> on('questions') -> onDelete('cascade');
			$table -> integer('quiz_id') -> unsigned() -> index();
			$table -> foreign('quiz_id') -> references('id') -> on('quizes') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('question_quiz');
	}

}
