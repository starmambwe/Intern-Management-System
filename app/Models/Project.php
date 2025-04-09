<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date'
    ];

    /**
     * Get all supervisors assigned to this project
     */
    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'project_user')
                   ->wherePivot('role', 'supervisor')
                   ->withTimestamps();
    }

    /**
     * Get all interns assigned to this project
     */
    public function interns()
    {
        return $this->belongsToMany(User::class, 'project_user')
                   ->wherePivot('role', 'intern')
                   ->withTimestamps();
    }

    /**
     * Get all users assigned to this project (both supervisors and interns)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
                   ->withPivot('role')
                   ->withTimestamps();
    }
}
