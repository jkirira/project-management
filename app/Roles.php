<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    protected $guarded = [];

    protected $fillable = ['name'];

    public const IS_TENANT = 1;
    public const IS_MANAGER = 2;
    public const IS_SUPERVISOR = 3;


}
