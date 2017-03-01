<?php

use Illuminate\Database\Seeder;

class dummy_warehouse extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('warehouses')->insert([
            'name'          => "Gudang",
            'alamat'       	=> '',
        ]);
        \DB::table('warehouses')->insert([
        	'name' 			=> "Dummy Ware".str_random(10),
            'alamat'       	=> 'disana',
        ]);
    }
}
