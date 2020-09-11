<?php

use Illuminate\Database\Seeder;
use App\Models\LogType;

class LogTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LogType::firstOrCreate(['name' => 'Sent']);
        LogType::firstOrCreate(['name' => 'Opened']);
        LogType::firstOrCreate(['name' => 'Clicked']);
        LogType::firstOrCreate(['name' => 'Filled']);
        LogType::firstOrCreate(['name' => 'Reported']);
    }
}
