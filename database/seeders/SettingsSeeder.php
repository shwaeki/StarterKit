<?php

namespace Database\Seeders;

use anlutro\LaravelSettings\Facade as Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('company_name', 'Inventory Management');
        Setting::set('company_email', 'info@example.com');
        Setting::set('company_phone', '+972500000000');
        Setting::set('company_address', 'Palestine');
        Setting::set('company_city', 'Jerusalem');
        Setting::set('company_currency_symbol', '₪');
        Setting::set('record_per_page', 10);
        Setting::set('default_role', 2);
        Setting::set('max_login_attempts', 3);
        Setting::set('lockout_delay', 2);
        Setting::save();
    }
}
