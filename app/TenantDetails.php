<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantDetails extends Model
{

    protected $guarded = [];

//    protected $with = ['user'];
//
//
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'tenant_id', 'user_id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'tenant_id');
    }
}
