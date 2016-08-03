<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name'
    ];

    /**
     * soft delete fields 
     */
    protected $dates = [
        'deleted_at',
    ];

    public function milestones() 
    {
    	return $this->hasMany('App\Models\Milestone');
    }
}
