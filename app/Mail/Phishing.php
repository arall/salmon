<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Hook;

class Phishing extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Hook
     */
    protected $hook;

    /**
     * @var string
     */
    protected $template;

    /**
     * Create a new message instance.
     *
     * @param string $template
     * @param Hook   $hook
     * @return void
     */
    public function __construct($template, Hook $hook)
    {
        $this->hook = $hook;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $domain = $this->hook->campaign->domain->name;
        $template = $this->hook->campaign->template;

        $this->subject($template->subject)
                    ->from($template->from_address ?: 'no-reply@' . $domain, $template->from_name)
                    ->view($this->template)
                    ->with([
                        'template' => $template,
                        'domain' => $domain,
                        'name' => $this->hook->target->name,
                        'email' => $this->hook->target->email,
                        'token' => $this->hook->token
                    ]);

        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()->addTextHeader(env('MAIL_HEADER'), true);
        });

        return $this;
    }
}
