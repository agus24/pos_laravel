<?php

use Illuminate\Database\Seeder;

class dummy_kartu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('kartus')->insert([
        	['name' => "BCA"],
        	['name' => "BRI"],
        	['name' => "Mandiri"],
        	['name' => "BNI"],
        ]);
    }
}
