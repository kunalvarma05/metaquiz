<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveStatusColumnFromFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('friends', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('friends', function(Blueprint $table)
		{
			$table->string('status')->nullable();
		});
	}

}
