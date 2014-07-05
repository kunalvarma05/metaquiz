<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('courses', function(Blueprint $table) {
			$table -> increments('id');
			$table -> string('name') -> nullable();
			$table -> text('description') -> nullable();
			$table -> string('slug') -> nullable();
			$table -> text('picture') -> nullable();
			$table -> integer('organization_id') -> unsigned() -> nullable();
			$table -> foreign('organization_id') -> references('id') -> on('organizations') -> onDelete('cascade');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('courses');
	}

}
