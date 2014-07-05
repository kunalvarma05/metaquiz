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
			$table -> increments('id');
			$table -> string('roll_no') -> nullable();
			$table -> integer('user_id') -> unsigned() -> nullable();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');			
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
