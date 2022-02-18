<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function units()
    {
        $this->hasMany(Unit::class);
    }

    public function manager_details()
    {
        $this->hasOne(ManagerDetails::class, 'project_id');
    }

    public function manager()
    {
        $this->manager_details->user;
    }
}
