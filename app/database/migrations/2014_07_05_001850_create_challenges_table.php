<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('challenges', function(Blueprint $table) {
			$table -> increments('id');
			$table -> string('status') -> nullable();
			$table -> integer('challenger_id') -> unsigned() -> nullable();
			$table -> foreign('challenger_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('challenges');
	}

}
