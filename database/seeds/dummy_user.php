<?php

use Illuminate\Database\Seeder;

class dummy_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name'          => "agus24",
            'username'      => 'agus24',
            'password'      => bcrypt('rahasia'),
            'email'         => 'asdf@asdf.com',
            'alamat'       => 'disana',
            'phone'         => '123456',
            'ware_id'       => 1,
            'level_user'    => 2,
        ]);
        \DB::table('users')->insert([
        	'name'         => "admin",
        	'username'     => 'admin',
        	'password'     => bcrypt('admin'),
            'email'        => 'asdf@asdf.com',
            'alamat'       => 'disana',
            'phone'        => '123456',
            'ware_id'      => 1,
            'level_user'   => 1,
        ]);
    }
}
