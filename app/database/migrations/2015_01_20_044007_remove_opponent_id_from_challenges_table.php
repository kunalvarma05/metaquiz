<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveOpponentIdFromChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table->dropForeign('challenges_opponent_id_foreign');
			$table->dropColumn('opponent_id');
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
			$table -> integer('opponent_id') -> nullable() -> unsigned();
			$table -> foreign('opponent_id') -> references('id') -> on('users') -> onDelete('cascade');
		});
	}

}
