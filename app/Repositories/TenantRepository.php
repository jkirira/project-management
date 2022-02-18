<?php

namespace App\Repositories;

use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Interfaces\TenantInterface;
use App\Mail\NewTenant;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TenantRepository implements TenantInterface
{

    public function getAllTenants()
    {
        return User::where('role_id', 1)->latest()->get();
    }

    public function getTenantById($id)
    {
        return User::find($id);
    }


    public function addTenant(TenantRequest $request)
    {
        $request['password'] = Hash::make($request->national_id);

        $user = User::create($request->except(['role_id', 'unit_id', 'occupation']));
        $user->tenantDetails()->create([
            'user_id' => $user->id,
            'unit_id' => $request->unit_id,
            'occupation' => $request->occupation ?: '',
        ]);

//        Mail::to($user)->send(new NewTenant($user));

        return $user;
    }


    public function updateTenant(User $user, UpdateTenantRequest $request)
    {

        $user->update($request->except(['role_id', 'user_id', 'occupation']));

        $user->tenantDetails()->update([
            'user_id' => $user->id,
            'unit_id' => $request['unit_id'] ?: $user->tenantDetails->unit_id,
            'occupation' => $request['occupation'] ?: $user->tenantDetails->occupation,
        ]);

        return $user;
    }

    public function deleteTenant(User $user)
    {
        return $user->delete();
    }
}
