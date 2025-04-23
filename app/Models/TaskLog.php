<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;

class TaskLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'task_id', 'project_id', 'log_text'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function task() { return $this->belongsTo(Task::class); }
    public function project() { return $this->belongsTo(Project::class); }
}
