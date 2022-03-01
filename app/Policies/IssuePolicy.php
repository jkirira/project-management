<?php

namespace App\Policies;

use App\Roles;
use App\User;
use App\Issue;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any issues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the issue.
     *
     * @param  \App\User  $user
     * @param  \App\Issue  $issue
     * @return mixed
     */
    public function view(User $user, Issue $issue)
    {
        return auth()->check() && ( (auth()->user()->id == $issue->creator->id) || ( auth()->user()->id == $issue->manager->id) || (auth()->user()->role_id == Roles::IS_SUPERVISOR) );
    }

    /**
     * Determine whether the user can create issues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return auth()->check() && auth()->user()->role_id == Roles::IS_TENANT;
    }

    /**
     * Determine whether the user can update the issue.
     *
     * @param  \App\User  $user
     * @param  \App\Issue  $issue
     * @return mixed
     */
    public function update(User $user, Issue $issue)
    {
        return auth()->check() && auth()->user()->id == $issue->creator->id;
    }

    /**
     * Determine whether the user can delete the issue.
     *
     * @param  \App\User  $user
     * @param  \App\Issue  $issue
     * @return mixed
     */
    public function delete(User $user, Issue $issue)
    {
        return auth()->check() && auth()->user()->id == $issue->creator->id;
    }

    /**
     * Determine whether the user can restore the issue.
     *
     * @param  \App\User  $user
     * @param  \App\Issue  $issue
     * @return mixed
     */
    public function restore(User $user, Issue $issue)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the issue.
     *
     * @param  \App\User  $user
     * @param  \App\Issue  $issue
     * @return mixed
     */
    public function forceDelete(User $user, Issue $issue)
    {
        //
    }
}
