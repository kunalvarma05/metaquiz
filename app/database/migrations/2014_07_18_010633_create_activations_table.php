<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('activations', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> text('code') -> nullable();
			$table -> integer('activable_id') -> nullable() -> unsigned();
			$table -> string('activable_type') -> nullable();
			$table -> integer('organization_id') -> nullable() -> unsigned();
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
		Schema::drop('activations');
	}

}
