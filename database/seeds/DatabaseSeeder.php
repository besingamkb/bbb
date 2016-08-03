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
        $this->call(ProjectSeeder::class);
        $this->call(MilestoneSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MilestoneUserSeeder::class);
    }
}
