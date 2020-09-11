<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class LogType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Filters sent type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSent(Builder $query)
    {
        return $query->where('name', 'Sent');
    }

    /**
     * Filters opened type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpened(Builder $query)
    {
        return $query->where('name', 'Opened');
    }

    /**
     * Filters clicked type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClicked(Builder $query)
    {
        return $query->where('name', 'Clicked');
    }

    /**
     * Filters filled type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilled(Builder $query)
    {
        return $query->where('name', 'Filled');
    }

    /**
     * Reported filled type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReported(Builder $query)
    {
        return $query->where('name', 'Reported');
    }

    /**
     * Hooks relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hooks()
    {
        return $this->hasMany('App\Models\Hook');
    }

    /**
     * Logs relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Log');
    }
}
