<?php

use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('milestones')->insert([
        	[
        		'project_id' => 1,
        		'milestone_name' => 'Report Sign Off',
        		'release' => \Carbon\Carbon::create(2016, 5, 30),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 1,
        		'milestone_name' => 'All Pages Sign Off',
        		'release' => \Carbon\Carbon::create(2016, 6, 6),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 1,
        		'milestone_name' => 'Build Phase 1',
        		'release' => \Carbon\Carbon::create(2016, 6, 20),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 1,
        		'milestone_name' => 'Tweaks / Go Live',
        		'release' => \Carbon\Carbon::create(2016, 6, 27),
                'is_important' => 1,
        	],
        	[
        		'project_id' => 2,
        		'milestone_name' => 'Planning',
        		'release' => \Carbon\Carbon::create(2016, 5, 30),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 2,
        		'milestone_name' => 'Home Page Sign Off',
        		'release' => \Carbon\Carbon::create(2016, 6, 6),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 2,
        		'milestone_name' => 'All Pages Sign Off',
        		'release' => \Carbon\Carbon::create(2016, 6, 20),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 2,
        		'milestone_name' => 'Build',
        		'release' => \Carbon\Carbon::create(2016, 6, 27),
                'is_important' => 0,
        	],
        	[
        		'project_id' => 2,
        		'milestone_name' => 'Tweaks / Go Live',
        		'release' => \Carbon\Carbon::create(2016, 7, 4),
                'is_important' => 1,
        	]
        ]);
    }
}
