<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilestoneUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'days', 'milestone_id', 'user_id',
    ];

    protected $table = "milestone_user";

    public function users() 
    {
    	return $this->belongsToMany('App\Models\User');
    }

    public function milestones() 
    {
    	return $this->belongsToMany('App\Models\Milestone');
    }
}
