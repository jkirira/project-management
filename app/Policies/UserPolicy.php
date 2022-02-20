<?php

namespace App\Policies;

use App\Roles;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, $id)
    {
        return auth()->check() && ( auth()->user()->id == $id || auth()->user()->role_id == Roles::IS_MANAGER || auth()->user()->role_id == Roles::IS_SUPERVISOR );
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create_tenant(User $user)
    {
        return auth()->check() && auth()->user()->role_id == Roles::IS_MANAGER;
    }
    public function create_manager(User $user)
    {
        return auth()->check() && auth()->user()->role_id == Roles::IS_SUPERVISOR;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update_tenant(User $user)
    {
        return auth()->check() && ( auth()->user()->id == $user->id || auth()->user()->role_id >= Roles::IS_MANAGER);
    }
    public function update_manager(User $user)
    {
        return auth()->check() && ( auth()->user()->id == $user->id ||auth()->user()->role_id == Roles::IS_SUPERVISOR);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user)
    {
        return auth()->check() && ( auth()->user()->id == $user->id || auth()->user()->role_id >= Roles::IS_MANAGER);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
