<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $guarded = [];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function manager_details()
    {
        return $this->hasOne(ManagerDetails::class, 'project_id') ?: null;
    }

    public function manager()
    {
        if ($this->manager_details == null) {
            return new BelongsTo($this->newQuery(), $this, '', '', '');
        }
        return $this->manager_details->user;
    }
}
