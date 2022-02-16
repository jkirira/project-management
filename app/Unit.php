<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = [];

    protected $with = ['tenant'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tenant()
    {
        return $this->hasOne(TenantDetails::class);
    }
}
