<?php

use Illuminate\Database\Seeder;

class dummy_category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            'name'          => "Dummy Category ".str_random(10)
        ]);
        \DB::table('categories')->insert([
        	'name' 			=> "Dummy Category ".str_random(10)
        ]);
    }
}
