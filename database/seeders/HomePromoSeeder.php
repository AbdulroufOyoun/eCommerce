<?php

namespace Database\Seeders;

use App\Models\HomePromo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HomePromo::create([
            'title' => 'test',
            'video' => '',
            'is_video' => false
        ]);
    }
}
