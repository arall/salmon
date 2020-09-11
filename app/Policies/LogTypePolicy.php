<?php

namespace App\Policies;

use App\Models\LogType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LogType  $logType
     * @return mixed
     */
    public function view(User $user, LogType $logType)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LogType  $logType
     * @return mixed
     */
    public function update(User $user, LogType $logType)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LogType  $logType
     * @return mixed
     */
    public function delete(User $user, LogType $logType)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LogType  $assetLog
     * @return mixed
     */
    public function restore(User $user, LogType $assetLog)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\LogType  $logType
     * @return mixed
     */
    public function forceDelete(User $user, LogType $logType)
    {
        return false;
    }
}
