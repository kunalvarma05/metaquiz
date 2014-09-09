<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('quizes', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('challenge_id') -> nullable() -> unsigned();
			$table -> foreign('challenge_id') -> references('id') -> on('challenges') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('quizes');
	}

}
