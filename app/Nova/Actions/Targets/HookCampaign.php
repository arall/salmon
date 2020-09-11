<?php

namespace App\Nova\Actions\Targets;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use App\Models\Campaign;

class HookCampaign extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $campaign = Campaign::find($fields->campaign);
        if (!$campaign) {
            return Action::danger('Campaign not found');
        }

        foreach ($models as $model) {
            $model->hooks()->firstOrCreate(['campaign_id' => $campaign->id]);
        }

        return Action::message('Targets added');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Campaign')->options(Campaign::pluck('name', 'id')->toArray())->rules('required'),
        ];
    }
}
