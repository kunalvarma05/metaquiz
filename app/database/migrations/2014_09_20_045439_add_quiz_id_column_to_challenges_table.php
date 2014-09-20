<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddQuizIdColumnToChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table -> integer('quiz_id') -> nullable() -> unsigned();
			$table -> foreign('quiz_id') -> references('id') -> on('quizes') -> onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table->dropForeign('challenges_quiz_id_foreign');
			$table->dropColumn('quiz_id');
		});
	}

}
