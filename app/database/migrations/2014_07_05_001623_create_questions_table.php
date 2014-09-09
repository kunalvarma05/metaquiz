<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('questions', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> text('title') -> nullable();
			$table -> integer('chapter_id') -> nullable() -> unsigned();
			$table -> foreign('chapter_id') -> references('id') -> on('chapters') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('questions');
	}

}
