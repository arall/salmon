<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TemplatesSeeder::class);
        $this->call(LogTypesSeeder::class);
        $this->call(CampaignStatusesSeeder::class);
        $this->call(CampaignTypesSeeder::class);
    }
}
