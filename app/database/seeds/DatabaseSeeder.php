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
		$this->call('UnavailableSeeder');
		$this->call('AppointmentsSeeder');
		$this->call('AppointmentUsersSeeder');
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
									'password' => '$2y$10$OEipbmjQHgCa8445K/SKcO8icDji7hH/5xhklU27hEQhUrY3u7KW.',
									'is_active' => true
									));

		User::create(array('fname' => 'Timmy',
									'lname' => 'Garrabrant',
									'email' => 'timmy@email.arizona.edu',
									'phone' => '520555556',
									'password' => '$2y$10$OEipbmjQHgCa8445K/SKcO8icDji7hH/5xhklU27hEQhUrY3u7KW.',
									'is_active' => true
									));

		User::create(array('fname' => 'Chad',
									'lname' => 'Nierenhausen',
									'email' => 'chad@email.arizona.edu',
									'phone' => '520555557',
									'password' => '$2y$10$OEipbmjQHgCa8445K/SKcO8icDji7hH/5xhklU27hEQhUrY3u7KW.',
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

		// Timmy belongs to Accelerated Masters Program category
		DB::table('advisor_categories')->insert(array('user_id' => '2',
																		'category_id' => '1'));

		// Timmy belongs to Graduate Students: Assistantship
		DB::table('advisor_categories')->insert(array('user_id' => '2',
																		'category_id' => '2'));

		// Chad belongs to Graduate Students: Assistantship
		DB::table('advisor_categories')->insert(array('user_id' => '3',
																		'category_id' => '2'));

		// Chad belongs to Graduate Students: Plan of Study
		DB::table('advisor_categories')->insert(array('user_id' => '3',
																		'category_id' => '3'));
	}
}

class UnavailableSeeder extends Seeder {
	public function run()
	{
		$dt_start = Carbon::now();
		$dt_end = Carbon::now();

		$dt_start->year(2014)->month(11)->day(3)->hour(9)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(9)->minute(30)->second(0);

		// Timmy
		Unavailable::create(array('user_id' => '2',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(12)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(17)->minute(0)->second(0);

		// Timmy
		Unavailable::create(array('user_id' => '2',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(12)->day(1)->hour(8)->minute(0)->second(0);
		$dt_end->year(2014)->month(12)->day(1)->hour(9)->minute(30)->second(0);

		// Timmy
		Unavailable::create(array('user_id' => '2',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(10)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(11)->minute(0)->second(0);

		// Chad
		Unavailable::create(array('user_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(11)->day(3)->hour(12)->minute(0)->second(0);
		$dt_end->year(2014)->month(11)->day(3)->hour(15)->minute(15)->second(0);

		// Chad
		Unavailable::create(array('user_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(12)->day(3)->hour(12)->minute(0)->second(0);
		$dt_end->year(2014)->month(12)->day(3)->hour(13)->minute(0)->second(0);

		// Chad
		Unavailable::create(array('user_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(12)->day(5)->hour(9)->minute(0)->second(0);
		$dt_end->year(2014)->month(12)->day(5)->hour(14)->minute(0)->second(0);

		// Chad
		Unavailable::create(array('user_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(12)->day(9)->hour(8)->minute(0)->second(0);
		$dt_end->year(2014)->month(12)->day(9)->hour(15)->minute(15)->second(0);

		// Chad
		Unavailable::create(array('user_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));
	}
}

class AppointmentsSeeder extends Seeder {
	public function run()
	{
		$dt_start = Carbon::now();
		$dt_end = Carbon::now();

		$dt_start->year(2014)->month(12)->day(4)->hour(9)->minute(15)->second(0);
		$dt_end->year(2014)->month(12)->day(4)->hour(9)->minute(30)->second(0);

		Appointment::create(array('category_id' => '1',
											'start' => $dt_start,
											'end' => $dt_end));

		$dt_start->year(2014)->month(12)->day(2)->hour(13)->minute(0)->second(0);
		$dt_end->year(2014)->month(12)->day(2)->hour(14)->minute(0)->second(0);

		Appointment::create(array('category_id' => '3',
											'start' => $dt_start,
											'end' => $dt_end));
	}
}

class AppointmentUsersSeeder extends Seeder {
	public function run()
	{
		DB::table('appointment_users')->delete();

		// Homero is attending appointment 1
		DB::table('appointment_users')->insert(array('appointment_id' => '1',
																		'user_id' => '1',
																		'is_advising' => false));
		// Timmy is advising appointment 1
		DB::table('appointment_users')->insert(array('appointment_id' => '1',
																		'user_id' => '2',
																		'is_advising' => true));

		// Homero is attending appointment 2
		DB::table('appointment_users')->insert(array('appointment_id' => '2',
																		'user_id' => '1',
																		'is_advising' => false));

		// Timmy is advising appointment 2
		DB::table('appointment_users')->insert(array('appointment_id' => '2',
																		'user_id' => '2',
																		'is_advising' => true));

		// Chad is also advising appointment 2
		DB::table('appointment_users')->insert(array('appointment_id' => '2',
																		'user_id' => '3',
																		'is_advising' => true));
	}
}