<?php

namespace App\Interfaces;

use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\User;

interface TenantInterface
{

    public function getAllTenants();

    public function getTenantById($id);

    public function addTenant(TenantRequest $request);

    public function updateTenant(User $user, UpdateTenantRequest $request);

    public function deleteTenant(User $user);
}
