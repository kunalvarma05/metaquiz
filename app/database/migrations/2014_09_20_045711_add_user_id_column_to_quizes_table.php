<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdColumnToQuizesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quizes', function(Blueprint $table)
		{
			$table -> integer('user_id') -> nullable() -> unsigned();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
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
			$table->dropForeign('quizes_user_id_foreign');
			$table->dropColumn('user_id');
		});
	}

}
