<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
