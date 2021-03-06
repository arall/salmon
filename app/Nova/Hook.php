<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;

class Hook extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Hook::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'token';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'token',
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
            BelongsTo::make('Campaign'),
            BelongsTo::make('Target'),
            Text::make('Token')->onlyOnDetail(),
            BelongsTo::make('Status', 'lastLogType', 'App\\Nova\\LogType'),
            HasMany::make('Logs'),
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
            (new Actions\Hooks\Report)->canRun(function ($request, $model) {
                return true;
            })->confirmText('Are you sure you want to mark this hook as reported?')
        ];
    }
}
