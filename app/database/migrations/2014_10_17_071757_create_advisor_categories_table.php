<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvisorCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advisor_categories', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('advisor_id')->unsigned();
			$table->foreign('advisor_id')->references('id')->on('users');
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories');						
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('advisor_categories');
	}

}
