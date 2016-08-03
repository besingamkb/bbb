<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
    		['project_name' => 'Model Office'],
    		['project_name' => 'Wildfood Cafe']
    	]);
    }
}
