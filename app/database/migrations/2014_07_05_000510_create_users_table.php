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
			$table -> increments('id');
			$table -> string('name') -> nullable();
			$table -> string('email') -> nullable();
			$table -> text('password') -> nullable();
			$table -> text('picture') -> nullable();
			$table -> string('type') -> nullable();
			$table -> string('fbid') -> nullable();
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
		Schema::drop('users');
	}

}
