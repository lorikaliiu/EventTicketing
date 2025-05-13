<?php


namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenuesSeeder extends Seeder
{
    public function run()
    {
        Venue::create([
            'name' => 'Grand Concert Hall',
            'location' => '123 Main Street, Cityville',
            'capacity' => 1000
        ]);

        Venue::create([
            'name' => 'Sports Arena',
            'location' => '456 Sports Lane, Sportstown',
            'capacity' => 5000
        ]);

        Venue::create([
            'name' => 'Community Theater',
            'location' => '789 Arts Boulevard, Artsville',
            'capacity' => 300
        ]);
    }
}
