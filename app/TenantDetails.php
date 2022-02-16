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
}
