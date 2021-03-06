<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChaptersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('chapters', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('name') -> nullable();
			$table -> text('description') -> nullable();
			$table -> string('icon') -> nullable();
			$table -> string('slug') -> nullable();
			$table -> integer('subject_id') -> nullable() -> unsigned();
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
		Schema::drop('chapters');
	}

}
