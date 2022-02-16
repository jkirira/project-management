<?php

namespace App\Repositories;

use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\User;

class UserRepository implements UserInterface
{

    public function getAllUsers()
    {
        return User::latest()->get();
    }

//    public function getTenants(){}
//    public function getManagers(){}

    public function getUserById($id)
    {
        return User::find($id);
    }

//    public function addUser(UserRequest $request)
//    {
//        $validated = $request->validated();
//
//        User::create($validated);
//    }

    public function addTenant(UserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);
        $user->tenantDetails()->create([
            'user_id' => $user->id,
            'unit_id' => $request->unit_id,
            'occupation' => $request->occupation ?: '',
        ]);

        return $user;
    }

    public function addManager(UserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        $user->managerDetails()->create([
            'user_id' => $user->id,
            'project_id' => $request['project_id'] ?: '',
            'supervisor_id' => $request['supervisor_id'] ?: '',
        ]);

        return $user;

    }

    public function updateManager(User $user, UserRequest $request)
    {
        $validated = $request->validated();

//        dd($validated);
        $user->update($validated);

        $user->managerDetails()->update([
            'user_id' => $user->id,
            'project_id' => $request['project_id'],
            'supervisor_id' => $request['supervisor_id'],
        ]);

        return $user;
    }

    public function updateTenant(User $user, UserRequest $request)
    {
        $validated = $request->validated();

        $user->update($validated);

        $user->tenantDetails()->update([
            'user_id' => $user->id,
            'unit_id' => $request['unit_id'],
            'occupation' => $request['occupation'],
        ]);

        return $user;
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
