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
        // $this->call(MenuList::class);
        // $this->call(dummy_userAccess::class);

        
        // $this->call(dummy_user::class);
        // $this->call(dummy_warehouse::class);
        // $this->call(dummy_category::class);
        // $this->call(dummy_subCategory::class);
        // $this->call(dummy_harga::class);
        // $this->call(dummy_customer::class);
        // $this->call(dummy_kartu::class);
        // $this->call(dummy_karyawan::class);
        // $this->call(dummy_stockcard::class);
        // $this->call(dummy_purchaseSeeder::class);
        

        $this->call(dummy_barang::class);
    }
}
