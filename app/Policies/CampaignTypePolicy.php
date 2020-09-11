<?php

namespace App\Policies;

use App\Models\CampaignType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignTypePolicy
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
     * @param  \App\Models\CampaignType  $campaignType
     * @return mixed
     */
    public function view(User $user, CampaignType $campaignType)
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
     * @param  \App\Models\CampaignType  $campaignType
     * @return mixed
     */
    public function update(User $user, CampaignType $campaignType)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CampaignType  $campaignType
     * @return mixed
     */
    public function delete(User $user, CampaignType $campaignType)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CampaignType  $assetLog
     * @return mixed
     */
    public function restore(User $user, CampaignType $assetLog)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CampaignType  $campaignType
     * @return mixed
     */
    public function forceDelete(User $user, CampaignType $campaignType)
    {
        return false;
    }
}
