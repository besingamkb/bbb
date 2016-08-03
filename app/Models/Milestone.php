<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'milestone_name', 'project_id', 'release',
    ];

    /**
     * soft delete fields 
     */
    protected $dates = [
        'deleted_at',
    ];

    public function project() 
    {
    	return $this->belongsTo('App\Models\Project');
    }

    public function users() 
    {
        return $this->belongsToMany('App\Models\User')->withPivot('days')->withTimestamps();
    }
}
