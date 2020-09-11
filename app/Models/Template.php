<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Mail\Phishing;

class Template extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'template', 'subject', 'from_address', 'from_name', 'fields'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
    ];

    /**
     * Get an instance of the associated Laravel Mail class.
     *
     * @param  Hook $hook
     * @return \Illuminate\Mail\Mailable
     */
    public function getMailInstance(Hook $hook)
    {
        return new Phishing($this->template, $hook);
    }

    /**
     * Get a test instance of the associated Laravel Mail class.
     *
     * @param  string $email
     * @param  Domain $domain
     * @return \Illuminate\Mail\Mailable
     */
    public function getTestMailInstance($email, Domain $domain)
    {
        $target = new Target;
        $target->email = $email;
        $campaign = new Campaign;
        $campaign->domain()->associate($domain);
        $campaign->template()->associate($this);
        $hook = new Hook;
        $hook->target()->associate($target);
        $hook->campaign()->associate($campaign);
        $hook->token = 'fake_token';

        return $this->getMailInstance($hook);
    }

    /**
     * Hooks relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->campaigns('App\Models\Campaign');
    }
}
