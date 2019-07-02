<?php

use Illuminate\Database\Seeder;

class governoratesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('governorates')->insert([
            'name' => 'الدقهليه',
           
        ]);
        DB::table('governorates')->insert([
            'name' => 'الغربيه',
           
        ]);
    }
}
