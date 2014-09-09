<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('students', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('roll_no') -> nullable();
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
		Schema::drop('students');
	}

}
