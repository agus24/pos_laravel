<?php

use Illuminate\Database\Seeder;

class dummy_userAccess extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_accesses')->insert([
        	[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 1,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 2,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 3,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 4,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 5,
        		"permission" 	=> 1,
        	],
        	[
                "user_id"       => 1,
                "menu_id"       => 6,
                "permission"    => 1,
            ],
            [
                "user_id"       => 1,
                "menu_id"       => 7,
                "permission"    => 1,
            ],
            [
                "user_id"       => 1,
                "menu_id"       => 8,
                "permission"    => 1,
            ],
            [
                "user_id"       => 1,
                "menu_id"       => 9,
                "permission"    => 1,
            ],
            [
                "user_id"       => 1,
                "menu_id"       => 12,
                "permission"    => 1,
            ],[
        		"user_id" 		=> 1,
        		"menu_id" 		=> 13,
        		"permission" 	=> 1,
        	],
        ]);

        \DB::table('user_accesses')->insert([
        	[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 1,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 2,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 3,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 4,
        		"permission" 	=> 1,
        	],
        	[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 5,
        		"permission" 	=> 1,
        	],
        	[
                "user_id"       => 2,
                "menu_id"       => 6,
                "permission"    => 1,
            ],
            [
                "user_id"       => 2,
                "menu_id"       => 7,
                "permission"    => 1,
            ],
            [
                "user_id"       => 2,
                "menu_id"       => 8,
                "permission"    => 1,
            ],
            [
                "user_id"       => 2,
                "menu_id"       => 9,
                "permission"    => 1,
            ],[
                "user_id"       => 2,
                "menu_id"       => 10,
                "permission"    => 1,
            ],[
                "user_id"       => 2,
                "menu_id"       => 11,
                "permission"    => 1,
            ],[
                "user_id"       => 2,
                "menu_id"       => 12,
                "permission"    => 1,
            ],[
        		"user_id" 		=> 2,
        		"menu_id" 		=> 13,
        		"permission" 	=> 1,
        	],
        ]);
    }
}
