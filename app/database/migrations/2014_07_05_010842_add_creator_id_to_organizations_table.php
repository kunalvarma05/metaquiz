<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCreatorIdToOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('organizations', function(Blueprint $table) {
			$table -> integer('creator_id') -> unsigned() -> index();
			$table -> foreign('creator_id') -> references('id') -> on('users') -> onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('organizations', function(Blueprint $table) {
			$table -> dropColumn('creator_id');
		});
	}

}
