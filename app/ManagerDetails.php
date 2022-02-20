<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerDetails extends Model
{
    protected $guarded = [];

    protected $with = ['project', 'supervisor'];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function project()
    {
        $this->belongsTo(Project::class, 'project_id');
    }

    public function supervisor()
    {
        $this->belongsTo(User::class, 'supervisor_id');
    }
}
