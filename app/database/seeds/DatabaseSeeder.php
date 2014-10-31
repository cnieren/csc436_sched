<?php

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

		$this->command->info("Categories table seeded!");
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
