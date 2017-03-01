<?php

use Illuminate\Database\Seeder;

class dummy_karyawan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('karyawans')->insert([
        	[
        		"name"=>"Fitri",
        	]
        ]);
    }
}
