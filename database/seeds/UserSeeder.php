<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
        		'name' => 'Hello World',
        		'email' => 'hello@world.com',
        		'display_image' => 'u75.png',
        		'password' => bcrypt('password'),
        	],
        	[
        		'name' => 'Jon Doe',
        		'email' => 'jon@doe.com',
        		'display_image' => 'u99.png',
        		'password' => bcrypt('password'),
        	],
        	[
        		'name' => 'Foo Bar',
        		'email' => 'foo@bar.com',
        		'display_image' => 'u101.png',
        		'password' => bcrypt('password'),
        	],
        ]);
    }
}
