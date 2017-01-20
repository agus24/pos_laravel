<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(dummy_user::class);
        $this->call(dummy_warehouse::class);
        $this->call(dummy_category::class);
        $this->call(dummy_subCategory::class);
        $this->call(dummy_harga::class);
    }
}
