<?php

namespace App\Repositories;

use App\Http\Requests\ManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\Interfaces\ManagerInterface;
use App\User;
use Illuminate\Support\Facades\Hash;

class ManagerRepository implements ManagerInterface
{

    public function getAllManagers()
    {
        return User::where('role_id', 2)->latest()->get();
    }

    public function getManagerById($id)
    {
        return User::find($id);
    }

    public function addManager(ManagerRequest $request)
    {

        $request['password'] = Hash::make($request->national_id);
        $user = User::create($request->except(['project_id', 'supervisor_id', 'user_id', 'role_id']));
        $user->update(['role_id' => 2]);
        $user->managerDetails()->create([
            'user_id' => $user->id,
            'project_id' => $request['project_id'] ?: '',
            'supervisor_id' => auth()->user()->id,
        ]);

        return $user;
    }


    public function updateManager(User $user, UpdateManagerRequest $request)
    {

        $user->update($request->except(['project_id', 'supervisor_id', 'user_id', 'role_id']));

        $user->managerDetails()->update([
            'user_id' => $user->id,
            'project_id' => $request['project_id'] ?: $user->managerDetails->project_id,
            'supervisor_id' => $request['supervisor_id'] ?: $user->managerDetails->supervisor_id,
        ]);

        return $user;
    }

    public function deleteManager(User $user)
    {
        return $user->delete();
    }
}
