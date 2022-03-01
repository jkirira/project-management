<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];

    protected $with = ['owner'];

    public function owner(){

        return $this->belongsTo(User::class, 'user_id');
    }


    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function path()
    {
        return $this->issue->path()."#reply->{$this->id}";
    }

}
