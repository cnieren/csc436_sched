<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

/*
*	RUN THE FOLLOWING COMMAND:
*		
*		php artisan migrate:refresh --seed --force
*
*	TO RE-SEED THE DATABASE. THIS WILL RESET AUTO-INCREMENT COUNTERS.
*/ 

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CategoriesTableSeeder');		
		$this->call('UserTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('UserRolesTableSeeder');
		$this->call('AdvisorCategoriesSeeder');
		$this->call('AvailableSeeder');
	}
}

class CategoriesTableSeeder extends Seeder {
	public function run()
	{
		DB::table('categories')->delete();

		Category::create(array('name' => 'Accelerated Masters Program'));
		Category::create(array('name' => 'Graduate Students: Assistantship'));
		Category::create(array('name' => 'Graduate Students: Plan of Study'));
		Category::create(array('name' => 'Graduate Students: Prospective Student'));
		Category::create(array('name' => 'Graduate Students: Thesis/Dissertation'));
		Category::create(array('name' => 'Undergrad: Career Advising'));
		Category::create(array('name' => 'Undergrad: CSC Majors'));
		Category::create(array('name' => 'Undergrad: Degree Check/Graduation'));
		Category::create(array('name' => 'Undergrad: Incoming Transfer Student'));
		Category::create(array('name' => 'Undergrad: Pre-CSC Advising'));
		Category::create(array('name' => 'Undergrad: Probation Students'));
		Category::create(array('name' => 'Undergrad: Prospective CS major '));
		Category::create(array('name' => 'Undergrad: Transfer Course Pre-Approval '));
		Category::create(array('name' => 'Undergrad: UA Readmission/Returning'));
	}
}

class UserTableSeeder extends Seeder {
	public function run()
	{
		DB::table('users')->delete();

		User::create(array('fname' => 'Homero',
									'lname' => 'Pawlowski',
									'email' => 'homeski@email.arizona.edu',
									'phone' => '520555555',
									'salt' => 'blah',
									'salted_hash' => 'bl4h',
									'password' => '614h',
									'is_active' => true									
									));

		User::create(array('fname' => 'Timmy',
									'lname' => 'Garrabrant',
									'email' => 'timmy@email.arizona.edu',
									'phone' => '520555556',
									'salt' => 'blah',
									'salted_hash' => 'bl4h',
									'password' => '614h',
									'is_active' => true									
									));

		User::create(array('fname' => 'Chad',
									'lname' => 'Nierenhousen',
									'email' => 'chad@email.arizona.edu',
									'phone' => '520555557',
									'salt' => 'blah',
									'salted_hash' => 'bl4h',
									'password' => '614h',
									'is_active' => true									
									));
	}
}

class RolesTableSeeder extends Seeder {
	public function run()
	{
		DB::table('roles')->delete();

		Role::create(array('title' => 'Student'));
		Role::create(array('title' => 'Advisor'));
	}
}

class UserRolesTableSeeder extends Seeder {
	public function run()
	{
		DB::table('user_roles')->delete();

		// Homero is a student
		DB::table('user_roles')->insert(array('user_id' => '1',
															'role_id' => '1'));
		// Timmy is an advisor
		DB::table('user_roles')->insert(array('user_id' => '2',
															'role_id' => '2'));
		// Chad is an advisor
		DB::table('user_roles')->insert(array('user_id' => '3',
															'role_id' => '2'));
	}
}

class AdvisorCategoriesSeeder extends Seeder {
	public function run()
	{
		DB::table('advisor_categories')->delete();

		DB::table('advisor_categories')->insert(array('user_id' => '2',
																		'category_id' => '1'));

		DB::table('advisor_categories')->insert(array('user_id' => '2',
																		'category_id' => '2'));

		DB::table('advisor_categories')->insert(array('user_id' => '3',
																		'category_id' => '2'));

		DB::table('advisor_categories')->insert(array('user_id' => '3',
																		'category_id' => '3'));
	}
}

class AvailableSeeder extends Seeder {
	public function run()
	{
		$dt_start = Carbon::now();
		$dt_end = Carbon::now();

		$dt_start->year(2014)->month(11)->day(3)->hour(9)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(9)->minute(30)->second(0);

		Available::create(array('user_id' => '2',
											'start_time' => $dt_start,
											'end_time' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(12)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(5)->minute(0)->second(0);

		Available::create(array('user_id' => '2',
											'start_time' => $dt_start,
											'end_time' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(10)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(11)->minute(0)->second(0);

		Available::create(array('user_id' => '3',
											'start_time' => $dt_start,
											'end_time' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(12)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(3)->minute(15)->second(0);

		Available::create(array('user_id' => '3',
											'start_time' => $dt_start,
											'end_time' => $dt_end));		

	}
}