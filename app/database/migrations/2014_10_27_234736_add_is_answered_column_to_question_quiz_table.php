<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIsAnsweredColumnToQuestionQuizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('question_quiz', function(Blueprint $table)
		{
			$table->boolean("is_answered")->default("0");
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('question_quiz', function(Blueprint $table)
		{
			$table->dropColumn("is_answered");
		});
	}

}
