<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
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
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->status()->associate(CampaignStatus::idle()->first());
        });
    }

    /**
     * Check if the campaign was sent.
     *
     * @return boolean
     */
    public function isSent()
    {
        return $this->status_id === CampaignStatus::sent()->first()->id;
    }

    /**
     * Check if the campaign is idle.
     *
     * @return boolean
     */
    public function isIdle()
    {
        return $this->status_id === CampaignStatus::idle()->first()->id;
    }

    /**
     * Status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\CampaignStatus');
    }

    /**
     * Type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\CampaignType');
    }

    /**
     * Template relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo('App\Models\Template');
    }

    /**
     * Domain relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function logs()
    {
        return $this->hasManyThrough('App\Models\Log', 'App\Models\Hook');
    }
}
