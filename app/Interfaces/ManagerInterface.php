<?php

namespace App\Interfaces;

use App\Http\Requests\ManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use App\User;

interface ManagerInterface
{

    public function getAllManagers();

    public function getManagerById($id);

    public function addManager(ManagerRequest $request);

    public function updateManager(User $user, UpdateManagerRequest $request);

    public function deleteManager(User $user);
}
