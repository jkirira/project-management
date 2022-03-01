<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
//    protected $with = ['managerDetails', 'tenantDetails'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenantDetails()
    {
        return $this->hasOne(TenantDetails::class);
    }

    public function managerDetails()
    {
        return $this->hasOne(ManagerDetails::class);
    }

    public function role()
    {
        return $this->belongsToMany(Roles::class);
    }

    public function issues()
    {
        if ($this->tenantDetails == null) {
            return new HasMany($this->newQuery(), $this, '', '');
        }

        return $this->tenantDetails->issues();
    }

}
