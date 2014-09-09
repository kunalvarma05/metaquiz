<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('subjects', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('name') -> nullable();
			$table -> text('description') -> nullable();
			$table -> string('icon') -> nullable();
			$table -> string('slug') -> nullable();
			$table -> integer('course_id') -> nullable() -> unsigned();
			$table -> foreign('course_id') -> references('id') -> on('courses') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('subjects');
	}

}
