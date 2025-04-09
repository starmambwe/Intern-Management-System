<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsArchive extends Model
{
    use HasFactory;

    protected $table = 'projects_archive'; // Add this line
    
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'archived_by',
        'archived_at'
    ];

    // Add this date casting (NEW CODE)
    protected $casts = [
        'archived_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }

    public function getDurationAttribute()
    {
        $start = \Carbon\Carbon::parse($this->start_date);
        $end = $this->end_date ? \Carbon\Carbon::parse($this->end_date) : now();
        return $start->diff($end)->format('%m months %d days');
    }

    // Add this to enable timestamps
    public $timestamps = true;
}