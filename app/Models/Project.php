<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'user_id', 
        'created_by',
        'start_date',
        'deadline',
        'project_picture',
    ];
    
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')->withPivot('role');
    }
    public function users()
    {
        return $this->belongsTo(User::class); 
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
    public function files(): HasMany
    {
        return $this->hasMany(ProjectFile::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($project) {
            if ($project->user_id) {
                $project->members()->attach($project->user_id, ['role' => 'owner']); // Use attach() for member addition
            }
        });
    }
}
