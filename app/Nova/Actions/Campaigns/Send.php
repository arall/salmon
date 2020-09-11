<?php

namespace App\Nova\Actions\Campaigns;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Jobs\Campaign\Email\Send as Job;
use App\Models\CampaignStatus;

class Send extends Action
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
        foreach ($models as $model) {
            if (!$model->isIdle()) {
                return Action::danger($model, 'Campaign was already sent');
            }

            if (!$model->hooks()->count()) {
                return Action::danger($model, 'There are no targets');
            }

            $model->status()->associate(CampaignStatus::scheduled()->first());
            $model->save();

            Job::dispatch($model);

            return Action::message('Campaign scheduled');
        }
    }
}
