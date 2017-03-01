<?php

use Illuminate\Database\Seeder;

class dummy_stockcard extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('stock_cards')->insert([
        	[
        		"tanggal" => \Carbon\Carbon::now(),
				"barang_id" => 1,
				"qty" => 5,
				"tipe" => 'In',
                "description" => "Dummy",
				"ware_id" => 1,
        	],
        	[
        		"tanggal" => \Carbon\Carbon::now(),
				"barang_id" => 2,
				"qty" => 2,
				"tipe" => 'Out',
				"description" => "Dummy",
                "ware_id" => 1 
        	],
        ]);
    }
}
