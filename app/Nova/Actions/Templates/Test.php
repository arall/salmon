<?php

namespace App\Nova\Actions\Templates;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Facades\Mail;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Config;

class Test extends Action
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
        $domain = Domain::find($fields->domain);
        if (!$domain) {
            return Action::danger('Domain not found');
        }

        Config::set('services.mailgun.domain', $domain->name);
        foreach ($models as $model) {
            Mail::to($fields->email)->send($model->getTestMailInstance($fields->email, $domain));
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('email')->withMeta(['value' => Auth::user()->email])->rules('required'),
            Select::make('Domain')->options(Domain::pluck('name', 'id')->toArray())->rules('required'),
        ];
    }
}
