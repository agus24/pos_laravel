<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class dummy_purchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase')->insert([
        	[
        		"no_purchase" => "PUR/1/2016/IV/001",
        		'tanggal' => Carbon::now(),
				'id_supplier' => 1,
				'grand_total' => rand(1000,10000),
				'ware_id' => 1,
        	],[
        		"no_purchase" => "PUR/1/2016/IV/002",
        		'tanggal' => Carbon::now(),
				'id_supplier' => 2,
				'grand_total' => rand(5000,10000),
				'ware_id' => 1,
        	]
        ]);
    }
}
