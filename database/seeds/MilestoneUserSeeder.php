<?php

use Illuminate\Database\Seeder;

class MilestoneUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('milestone_user')->insert([
        	[
        		'milestone_id' => 1,
        		'user_id' => 1,
        		'days' => 2,
        	],
        	[
        		'milestone_id' => 2,
        		'user_id' => 1,
        		'days' => 2.5,
        	],
        	[
        		'milestone_id' => 3,
        		'user_id' => 3,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 4,
        		'user_id' => 3,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 5,
        		'user_id' => 2,
        		'days' => 2,
        	],
        	[
        		'milestone_id' => 6,
        		'user_id' => 1,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 7,
        		'user_id' => 2,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 7,
        		'user_id' => 1,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 8,
        		'user_id' => 3,
        		'days' => 5,
        	],
        	[
        		'milestone_id' => 9,
        		'user_id' => 3,
        		'days' => 5,
        	]
        ]);
    }
}
