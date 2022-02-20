<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    protected $guarded = [];

    protected $with = ['rating'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function($builder) {
            $builder->withCount('replies');
        });

//        static::addGlobalScope('creator', function($builder) {
//            $builder->withCount('creator');
//        });

        static::deleting(function($issue) {
            $issue->replies->each->delete();
        });

    }


    public function path()
    {
        return '/issues/'.$this->id;

    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function resolve()
    {
        $this->update(['status' => 'resolved']);
    }

    public function unresolve()
    {
        $this->update(['status' => 'unresolved']);
    }

    public function unanswered()
    {
        $this->update(['status' => 'unanswered']);
    }

    public function addReply($reply)
    {
        if(auth()->user()->role_id > Roles::IS_TENANT){
            $this->unanswered();
        }

        $this->unresolve();

        $new_reply = $this->replies()->create($reply);
        return $new_reply;
    }

    public function addRating($reply)
    {
        $this->rating()->create($reply);
    }

    // accepts a set of filters
    public function scopeFilter($query, $filters)
    {
        //apply those filters to the current issue we have running
        return $filters->apply($query);
    }
}
