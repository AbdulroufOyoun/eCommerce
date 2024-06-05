<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'Home Promo',
            'value' => null,
            'description' => null,
        ]);

        Setting::create([
            'key' => 'About Us',
            'value' => null,
            'description' => null,
        ]);
    }
}
