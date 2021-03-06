<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPictureFieldsToOrganizationsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('organizations', function(Blueprint $table) {

			$table -> text('picture') -> nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('organizations', function(Blueprint $table) {

			$table -> dropColumn('picture');

		});
	}

}
