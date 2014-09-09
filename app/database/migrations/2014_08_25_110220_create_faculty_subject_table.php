<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacultySubjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('faculty_subject', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> integer('faculty_id') -> unsigned() -> index();
			$table -> foreign('faculty_id') -> references('id') -> on('faculties') -> onDelete('cascade');
			$table -> integer('subject_id') -> unsigned() -> index();
			$table -> foreign('subject_id') -> references('id') -> on('subjects') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('faculty_subject');
	}

}
