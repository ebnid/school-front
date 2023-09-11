<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['name' => 'name_en', 'value' => null]);
        Setting::create(['name' => 'name_bn', 'value' => null]);
        Setting::create(['name' => 'address_en', 'value' => null]);
        Setting::create(['name' => 'address_bn', 'value' => null]);
        Setting::create(['name' => 'admission_button_text', 'value' => null]);
        Setting::create(['name' => 'admission_button_link', 'value' => null]);
        Setting::create(['name' => 'principal_message_excerpt_1', 'value' => null]);
        Setting::create(['name' => 'principal_message_excerpt_2', 'value' => null]);
        Setting::create(['name' => 'email', 'value' => null]);
        Setting::create(['name' => 'mobile', 'value' => null]);
        Setting::create(['name' => 'banner', 'value' => null]);
        Setting::create(['name' => 'logo', 'value' => null]);
    }
}
