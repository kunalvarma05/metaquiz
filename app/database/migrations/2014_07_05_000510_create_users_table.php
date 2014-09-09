<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function(Blueprint $table) {
			$table -> increments('id') -> index();
			$table -> string('name') -> nullable();
			$table -> string('email') -> nullable();
			$table -> string('username') -> nullable();
			$table -> text('password') -> nullable();
			$table -> string('fbid') -> nullable();
			$table -> boolean('is_activated') -> nullable();
			$table -> integer('accountable_id') -> unsigned();
			$table -> string('accountable_type') -> nullable();
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
		Schema::drop('users');
	}

}
