<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTaskArchive extends Model
{
    use HasFactory;

    protected $table = 'project_task_archive';

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'due_date',
        'original_project_id',
        'archived_by',
        'archived_at',
    ];

    // Relationship to the original project
    public function originalProject()
    {
        return $this->belongsTo(Project::class, 'original_project_id');
    }

    // Relationship to the user who archived it
    public function archivedBy()
    {
        return $this->belongsTo(User::class, 'archived_by');
    }
}
