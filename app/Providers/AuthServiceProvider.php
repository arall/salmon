<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Hook' => 'App\Policies\HookPolicy',
        'App\Models\Log' => 'App\Policies\LogPolicy',
        'App\Models\LogType' => 'App\Policies\LogTypePolicy',
        'App\Models\CampaignType' => 'App\Policies\CampaignTypePolicy',
        'App\Models\CampaignStatus' => 'App\Policies\CampaignStatusPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
