<?php

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Template::firstOrCreate([
            'name'       => 'Test',
            'template'   => 'test.emails.test',
            'subject'    => 'Test',
        ]);

        Template::firstOrCreate([
            'name'       => 'Google - Password Reset',
            'template'   => 'google.emails.password-reset-image',
            'subject'    => 'New device signed in',
        ]);

        Template::firstOrCreate([
            'name'       => 'Google - Shared document',
            'template'   => 'google.emails.share',
            'subject'    => 'Shared document',
            'fields'     => [
                'from_name' => 'Management',
                'file'      => 'Salary',
            ]
        ]);
    }
}
