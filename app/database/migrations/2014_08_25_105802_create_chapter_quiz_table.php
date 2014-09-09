<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChapterQuizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('chapter_quiz', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('chapter_id') -> unsigned() -> index();
			$table -> foreign('chapter_id') -> references('id') -> on('chapters') -> onDelete('cascade');
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
		Schema::drop('chapter_quiz');
	}

}
