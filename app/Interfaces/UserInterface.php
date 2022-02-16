<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use App\User;

interface UserInterface
{

    public function getAllUsers();

    public function getUserById($id);

//    public function addUser(UserRequest $request);

    public function addTenant(UserRequest $request);

    public function addManager(UserRequest $request);

//    public function updateUser(User $user, UserRequest $request);

    public function updateTenant(User $user, UserRequest $request);

    public function updateManager(User $user, UserRequest $request);

    public function deleteUser(User $user);
}
