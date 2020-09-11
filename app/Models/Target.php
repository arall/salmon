<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

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
     * Departments relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('App\Models\Department');
    }
}