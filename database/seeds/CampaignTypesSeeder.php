<?php

use Illuminate\Database\Seeder;
use App\Models\CampaignType;

class CampaignTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampaignType::firstOrCreate(['name' => 'Email']);
    }
}
