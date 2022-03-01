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

    public function assign_tenant($user_id){

        if ($this->tenant){
            $this->tenant()->delete();
        }

        $unit = $this->tenant()->create([
            'user_id' => $user_id,
        ]);

        return response()->json(['unit' => $unit], 200);
    }

    public function remove_tenant(){
        $unit = $this->tenant()->delete();
        return response()->json(['unit' => $unit], 200);
    }

}
