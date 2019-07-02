<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        $this->call([
	        governoratesTableSeeder::class,
	        citiesTableSeeder::class,
	        bloodTypesTableSeeder::class,
	        categoriesTableSeeder::class,
    	]);
    }
}
