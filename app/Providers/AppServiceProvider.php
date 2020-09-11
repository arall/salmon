<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Faker\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('obfuscate', function ($input) {
            $input = trim($input, "\'\"");
            $result = '';
            $faker = Factory::create('en_US');

            foreach (str_split($input) as $char) {
                if (rand(0, 2) == 1) {
                    $result .= '<span style="display:none">' . $faker->realText(20) . '</span>';
                }
                $result .= '<span>' . $char . '</span>';
            }

            return $result;
        });
    }
}
