<?php

use Illuminate\Database\Seeder;

class citiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name' => 'طنطا',
            'governorate_id' =>'2',
           
        ]);
        DB::table('cities')->insert([
           'name' => 'المنصوره',
           'governorate_id' =>'1',
        ]);
       
    }
}
