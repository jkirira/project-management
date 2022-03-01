<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    protected $guarded = [];

    protected $with = ['manager_details'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('unitCount', function ($builder) {
            $builder->withCount('units');
        });

    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function manager_details()
    {
        return $this->hasOne(ManagerDetails::class);
    }
//
//    public function manager()
//    {
//        if ($this->manager_details == null) {
//            return new BelongsTo($this->newQuery(), $this, '', '', '');
//        }
//        return $this->manager_details->user;
//    }

    public function assign_manager($manager_id){

        if ($this->manager_details){
            $this->manager_details()->delete();
        }

        $this->manager_details()->create([
            'user_id' => $manager_id,
            'supervisor_id' => auth()->user()->id,
        ]);

        $issues = Issue::where('project_id', $this->id)->get();
        foreach ($issues as $issue)
        {
            $issue->update(['manager_id' => $manager_id]);
        }

        return response()->json(['project' => $this], 200);
    }

    public function remove_manager(){
        $this->manager_details()->delete();
        return response()->json(['project' => $this], 200);
    }
}
