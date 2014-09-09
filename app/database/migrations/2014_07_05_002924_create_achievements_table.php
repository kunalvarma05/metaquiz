<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('achievements', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('title') -> nullable();
			$table -> text('description') -> nullable();
			$table -> integer('required_points') -> nullable();
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('achievements');
	}

}
