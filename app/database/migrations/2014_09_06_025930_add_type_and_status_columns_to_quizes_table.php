<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeAndStatusColumnsToQuizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizes', function(Blueprint $table)
		{
			$table->string('type')->nullable();
			$table->string('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quizes', function(Blueprint $table)
		{
			$table->dropColumns(array('type'));
			$table->dropColumns(array('status'));
		});
	}

}
