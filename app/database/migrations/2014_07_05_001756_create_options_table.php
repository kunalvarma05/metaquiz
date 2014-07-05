<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('options', function(Blueprint $table) {
			$table -> increments('id');
			$table -> text('title') -> nullable();
			$table -> boolean('is_answer') -> nullable();
			$table -> integer('question_id') -> unsigned() -> nullable();
			$table -> foreign('question_id') -> references('id') -> on('questions') -> onDelete('cascade');			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('options');
	}

}
