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
            'name'          => "Dummy user ".str_random(10),
            'username'      => 'agus24',
            'password'      => bcrypt('rahasia'),
            'email'         => 'asdf@asdf.com',
            'alamat'       => 'disana',
            'phone'         => '123456',
            'ware_id'       => 1,
            'level_user'    => 1,
        ]);
        \DB::table('users')->insert([
        	'name'         => "Dummy user ".str_random(10),
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
