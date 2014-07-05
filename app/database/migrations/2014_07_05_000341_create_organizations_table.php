<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('organizations', function(Blueprint $table) {
			$table -> increments('id');
			$table -> string('name');
			$table -> text('description');
			$table -> string('slug');
			$table -> text('picture');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('organizations');
	}

}
