<?php

use Illuminate\Database\Seeder;
use Faker\Generator;

class dummy_customer extends Seeder
{
	private $faker;

	public function __construct(){
		$this->faker = new \Faker\Generator;
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('customers')->insert([
        	[
        		"name" => "Dummy Customer ".str_random(10),
        		"address" => str_random(10),
        		"email" => str_random(5).'@'.str_random(4).".com",
        		"phone" => "021".rand(1000,9999),
        	]
        ]);
    }
}
