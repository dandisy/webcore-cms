<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['key' => 'site_title', 'value' => 'Site Title', 'description' => 'Your site title'],
            ['key' => 'site_slogan', 'value' => 'Site Slogan', 'description' => 'Your site slogan'],
            ['key' => 'site_description', 'value' => 'Site Description', 'description' => 'Your site description'],
            ['key' => 'site_logo', 'value' => 'images/logo/logo.png', 'description' => 'Your site logo. Note : upload your logo using assets manager, and copy your uploded logo link to Value field in here'],
            ['key' => 'google_analytics', 'value' => 'google_analytics_code', 'description' => 'Your google analytics key'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/youraccount	', 'description' => 'Your facebook page'],
            ['key' => 'twitter', 'value' => 'https://www.twitter.com/youraccount	', 'description' => 'Your twitter page'],
            ['key' => 'language', 'value' => 'english', 'description' => 'Language for internationalization of your site'],
            ['key' => 'language', 'value' => 'indonesia', 'description' => 'Language for internationalization of your site']
        ]);
    }
}