<?php

use Illuminate\Database\Seeder;
use App\Models\CampaignStatus;

class CampaignStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampaignStatus::firstOrCreate(['name' => 'Idle']);
        CampaignStatus::firstOrCreate(['name' => 'Scheduled']);
        CampaignStatus::firstOrCreate(['name' => 'Sending']);
        CampaignStatus::firstOrCreate(['name' => 'Sent']);
    }
}
