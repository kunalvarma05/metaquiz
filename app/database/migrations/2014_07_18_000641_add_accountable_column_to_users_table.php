<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAccountableColumnToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('users', function(Blueprint $table) {
			$table -> integer('accountable_id') -> unsigned();
			$table -> string('accountable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('users', function(Blueprint $table) {
			$table -> dropColumn(array('accountable_id', 'accountable_type'));
		});
	}

}
