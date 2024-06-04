<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'description' => 'Welcome to our print eCommerce! We are a team of passionate designers and print experts who are dedicated to providing high-quality printing services to our customers.Our mission is to make printing easy and accessible for everyone. Whether you need business cards, flyers, posters, or any other printed materials, we have got you covered. We use the latest printing technology and the highest quality materials to ensure that your prints look amazing every time.',
        ]);
    }
}
