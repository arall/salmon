<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\KeyValue;
use App\Models\Domain;
use Auth;

class Template extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Template::class;

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
        'id', 'name', 'mail_class'
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
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:templates,name')
                ->updateRules('unique:templates,name,{{resourceId}}'),
            Text::make('Template')
                ->sortable()->nullable(),
            Text::make('Subject')->sortable()->rules('required', 'max:255'),
            Text::make('From Address')->sortable(),
            Text::make('From Name')->sortable(),
            KeyValue::make('Fields')->sortable(),
            Text::make('Render', function(){
                return $this->getTestMailInstance(Auth::user()->email, Domain::orderBy('id')->first())->render();
            })->asHtml()->onlyOnDetail(),
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
            new Actions\Templates\Test,
        ];
    }
}
