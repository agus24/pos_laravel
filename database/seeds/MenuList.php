<?php

use Illuminate\Database\Seeder;

class MenuList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // master
        \DB::table('menu_lists')->insert([
        	[
        		"name"      => "User",
				"link"      => "user",
                "icon"      => "icon-user",
				"parent"    => "Master",
        	],
        	[
        		"name"      => "store",
				"link"      => "warehouse",
				"icon"      => "icon-home",
                "parent"    => "Master",
        	],
        	[
        		"name"      => "barang",
				"link"      => "barang",
				"icon"      => "fa fa-cubes",
                "parent"    => "Master",
        	],
        	[
        		"name"      => "category",
				"link"      => "category",
				"icon"      => "fa fa-tasks",
                "parent"    => "Master",
        	],
        	[
        		"name"      => "Sub Category",
				"link"      => "subcategory",
				"icon"      => "fa fa-tasks",
                "parent"    => "Master",
        	],
        	[
                "name"      => "harga",
                "link"      => "harga",
                "icon"      => "fa fa-money",
                "parent"    => "Master",
            ],
            [
                "name"      => "Customer",
                "link"      => "customer",
                "icon"      => "icon-user",
                "parent"    => "Master",
            ],
            [
                "name"      => "Kartu",
                "link"      => "kartu",
                "icon"      => "icon-credit-card",
                "parent"    => "Master",
            ],
            [
        		"name"      => "Karyawan",
				"link"      => "karyawan",
				"icon"      => "icon-users",
                "parent"    => "Master",
        	],
        ]);

        //Inventory
        \DB::table('menu_lists')->insert([
            [
                "name"      => "Stock Card",
                "link"      => "stock_card",
                "icon"      => "fa fa-credit-card",
                "parent"    => "Inventory",
            ],
            [
                "name"      => "Purchase",
                "link"      => "purchase",
                "icon"      => "fa fa-shopping-cart",
                "parent"    => "Inventory",
            ],
            [
                "name"      => "Adjustment",
                "link"      => "adjustment",
                "icon"      => "fa fa-exchange",
                "parent"    => "Inventory",
            ],
            [
                "name"      => "Transfer",
                "link"      => "transfer",
                "icon"      => "fa fa-exchange",
                "parent"    => "Inventory",
            ]
        ]);

    }
}