<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointment_users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

			$table->integer('appointment_id')->unsigned();
			$table->foreign('appointment_id')->references('id')->on('appointments');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->boolean('is_advising');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('appointment_users');
	}

}
