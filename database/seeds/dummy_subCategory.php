<?php

use Illuminate\Database\Seeder;

class dummy_subCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('sub_categories')->insert([
            'name'          => "Dummy Sub Category ".str_random(10)
        ]);
        \DB::table('sub_categories')->insert([
        	'name' 			=> "Dummy Sub Category ".str_random(10)
        ]);
    }
}
