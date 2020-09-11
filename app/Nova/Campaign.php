<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Phishing\Stats\Stats;

class Campaign extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Campaign::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Status', 'status', 'App\\Nova\\CampaignStatus')->exceptOnForms(),
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:campaigns,name')
                ->updateRules('unique:campaigns,name,{{resourceId}}'),
            BelongsTo::make('Type', 'type', 'App\\Nova\\CampaignType'),
            BelongsTo::make('Template')->nullable(),
            BelongsTo::make('Domain')->nullable(),
            HasMany::make('Hooks'),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\Campaigns\Send)
            ->onlyOnDetail()
            ->confirmText('Are you sure you want to send this campaign?')
            ->confirmButtonText('Send')
            ->cancelButtonText("Cancel"),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new Stats)->build('sent', $request)->onlyOnDetail()->width('1/5'),
            (new Stats)->build('opened', $request)->onlyOnDetail()->width('1/5'),
            (new Stats)->build('clicked', $request)->onlyOnDetail()->width('1/5'),
            (new Stats)->build('filled', $request)->onlyOnDetail()->width('1/5'),
            (new Stats)->build('reported', $request)->onlyOnDetail()->width('1/5'),
        ];
    }
}
