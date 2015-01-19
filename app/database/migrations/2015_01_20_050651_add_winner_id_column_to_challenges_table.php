<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddWinnerIdColumnToChallengesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('challenges', function(Blueprint $table)
		{
			$table -> integer('winner_id') -> nullable() -> unsigned();
			$table -> foreign('winner_id') -> references('id') -> on('users') -> onDelete('cascade');
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
			$table->dropForeign('challenges_winner_id_foreign');
			$table->dropColumn('winner_id');
		});
	}

}
