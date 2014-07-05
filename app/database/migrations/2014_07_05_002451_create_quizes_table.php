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
			$table -> increments('id');
			$table -> integer('challenge_id') -> unsigned() -> nullable();
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
