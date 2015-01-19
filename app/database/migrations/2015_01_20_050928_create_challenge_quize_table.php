<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChallengeQuizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenge_quiz', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('challenge_id')->unsigned()->index();
			$table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
			$table->integer('quiz_id')->unsigned()->index();
			$table->foreign('quiz_id')->references('id')->on('quizes')->onDelete('cascade');
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
		Schema::drop('challenge_quiz');
	}

}
