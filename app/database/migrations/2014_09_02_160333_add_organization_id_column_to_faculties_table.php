<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrganizationIdColumnToFacultiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('faculties', function(Blueprint $table)
		{
			$table -> integer('organization_id') -> nullable() -> unsigned();
			$table -> foreign('organization_id') -> references('id') -> on('organizations') -> onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('faculties', function(Blueprint $table)
		{
			$table->dropColumn('organization_id');
		});
	}

}
