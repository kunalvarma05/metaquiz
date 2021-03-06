<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('results', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> boolean('is_draw') -> nullable();
			$table -> integer('winner_id') -> nullable() -> unsigned();
			$table -> foreign('winner_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> integer('quiz_id') -> nullable() -> unsigned();
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
		Schema::drop('results');
	}

}
