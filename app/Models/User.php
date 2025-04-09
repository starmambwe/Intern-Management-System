<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->withTimestamps(); // If you want to track when roles were assigned
    }


    /**
     * Get all projects where this user is a supervisor
     */
    public function supervisedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
                   ->wherePivot('role', 'supervisor')
                   ->withTimestamps();
    }

    /**
     * Get all projects where this user is an intern
     */
    public function internProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user')
                   ->wherePivot('role', 'intern')
                   ->withTimestamps();
    }

    /**
     * Check if user has supervisor role
     */
    public function isSupervisor()
    {
        return $this->roles()->where('name', 'supervisor')->exists();
    }

    /**
     * Check if user has intern role
     */
    public function isIntern()
    {
        return $this->roles()->where('name', 'intern')->exists();
    }
}
