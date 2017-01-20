<?php

use Illuminate\Database\Seeder;

class dummy_harga extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('hargas')->insert([
        	[
	        	'kode'          => str_random(3),
	        	'harga' 		=> rand(1000,50000)
			],[
				'kode' 			=> str_random(3),
				'harga' 		=> rand(1000,50000)
			]
		]);
    }
}
