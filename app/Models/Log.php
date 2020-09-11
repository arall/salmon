<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'type_id', 'data',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->date = $model->freshTimestamp();
        });

        static::created(function ($model) {
            $hook = $model->hook;
            $hook->lastLogType()->associate($hook->logs()->orderBy('type_id', 'DESC')->first()->type);
            $hook->save();
        });
    }

    /**
     * Filters sent type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSent(Builder $query)
    {
        return $query->where('type_id', LogType::sent()->first()->id);
    }

    /**
     * Filters opened type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpened(Builder $query)
    {
        return $query->where('type_id', LogType::opened()->first()->id);
    }

    /**
     * Filters clicked type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClicked(Builder $query)
    {
        return $query->where('type_id', LogType::clicked()->first()->id);
    }

    /**
     * Filters filled type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilled(Builder $query)
    {
        return $query->where('type_id', LogType::filled()->first()->id);
    }

    /**
     * Reported filled type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReported(Builder $query)
    {
        return $query->where('type_id', LogType::reported()->first()->id);
    }

    /**
     * Hook relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hook()
    {
        return $this->belongsTo('App\Models\Hook');
    }

    /**
     * Type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\LogType', 'type_id');
    }
}
