<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManagerDetails extends Model
{
    protected $guarded = [];

    public function manager()
    {
        $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        $this->belongsTo(Project::class);
    }

    public function supervisor()
    {
        $this->belongsTo(User::class, 'supervisor_id');
    }
}
