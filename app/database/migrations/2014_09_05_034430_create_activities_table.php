<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('message');
			$table->string('type');
			$table -> integer('user_id') -> nullable() -> unsigned();
			$table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
			$table -> integer('targetable_id') -> unsigned();
			$table -> string('targetable_type') -> nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('activities');
	}

}
