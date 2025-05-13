<?php


namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    public function run()
    {
        $adminId = User::where('email', 'admin@gmail.com')->first()->id;

        Event::create([
            'name' => 'Rock Music Festival',
            'description' => 'Annual rock music festival featuring top bands',
            'category' => 'Music',
            'start_time' => Carbon::now()->addDays(10),
            'end_time' => Carbon::now()->addDays(12),
            'price' => 99.99,
            'venue_id' => 1,
            'user_id' => $adminId
        ]);

        Event::create([
            'name' => 'Basketball Championship',
            'description' => 'National basketball championship finals',
            'category' => 'Sports',
            'start_time' => Carbon::now()->addDays(5),
            'end_time' => Carbon::now()->addDays(5)->addHours(3),
            'price' => 49.99,
            'venue_id' => 2,
            'user_id' => $adminId
        ]);

        Event::create([
            'name' => 'Comedy Night',
            'description' => 'An evening of stand-up comedy with famous comedians',
            'category' => 'Comedy',
            'start_time' => Carbon::now()->addDays(15),
            'end_time' => Carbon::now()->addDays(15)->addHours(2),
            'price' => 29.99,
            'venue_id' => 3,
            'user_id' => $adminId
        ]);
    }
}