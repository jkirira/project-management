<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerDetails extends Model
{
    protected $guarded = [];

    protected $with = ['user', 'supervisor'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
