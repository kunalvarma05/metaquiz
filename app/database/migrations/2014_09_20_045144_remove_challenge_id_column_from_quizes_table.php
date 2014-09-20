<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveChallengeIdColumnFromQuizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizes', function(Blueprint $table)
		{
			$table->dropForeign('quizes_challenge_id_foreign');
			$table->dropColumn('challenge_id');
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
			$table->integer('challenge_id');
		});
	}

}
