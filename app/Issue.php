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

    public function time_created()
    {
        $this->created_at->diffForHumans();
    }

    public function path()
    {
        return '/issues/'.$this->id;

    }

    public function replies()
    {
        return $this->hasMany(Reply::class)->latest();
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
        return $this;
    }

    public function unresolve()
    {
        $this->update(['status' => 'unresolved']);
        return $this;
    }

    public function unanswered()
    {
        $this->update(['status' => 'unanswered']);
        return $this;
    }

    public function assign_manager($manager_id)
    {
        return $this->update(['manager_id' => 'unanswered']);
    }

    public function addReply($reply)
    {
        if(auth()->user()->role_id == Roles::IS_TENANT){
            $this->unanswered();
        } else {
            $this->unresolve();
        }

        $this->replies()->create($reply);

        $new_reply = $this->replies->first();
        return $new_reply;
    }

    public function addRating($rating)
    {
        if($this->rating){
            $this->rating()->delete();
        }

        $this->rating()->create($rating);

        return $this;
    }

    // accepts a set of filters
    public function scopeFilter($query, $filters)
    {
        //apply those filters to the current issue we have running
        return $filters->apply($query);
    }
}
