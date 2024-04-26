<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'user_id', // Assuming this is the foreign key for the user who created the project
        'created_by', // You may want to remove this if it's not necessary
        'start_date',
        'deadline',
    ];
    
    public function members()
{
    return $this->belongsToMany(User::class, 'project_members')->withPivot('role');
}
    public function users()
    {
        return $this->hasMany(User::class); // Assuming one project belongs to one user
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
