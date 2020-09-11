<?php

namespace App\Jobs\Campaign\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Campaign;
use App\Models\LogType;
use App\Models\CampaignStatus;
use Config;

class Send implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Campaign
     */
    private $campaign;

    /**
     * Create a new job instance.
     *
     * @param  Campaign $campaign
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $logTypeSent = LogType::sent()->first();

        if ($this->campaign->isSent()) {
            return;
        }


        Config::set('services.mailgun.domain', $this->campaign->domain->name);
        foreach ($this->campaign->hooks as $hook) {
            // Avoid re-sending
            if ($hook->logs()->where('type_id', $logTypeSent->id)->count()) {
                continue;
            }

            $this->campaign->status()->associate(CampaignStatus::sending()->first());
            $this->campaign->save();

            // Send the email
            Mail::to($hook->target->email)->send($this->campaign->template->getMailInstance($hook));

            // Create the log
            $log = $hook->logs()->create([
                'type_id' => $logTypeSent->id,
            ]);
        }

        // Set the campaign status to Sent
        $this->campaign->status()->associate(CampaignStatus::sent()->first());
        $this->campaign->save();
    }
}
