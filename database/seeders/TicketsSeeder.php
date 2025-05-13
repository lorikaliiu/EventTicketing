<?php


namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketsSeeder extends Seeder
{
    public function run()
    {
        $userId = User::where('email', 'user@gmail.com')->first()->id;

        Ticket::create([
            'seat_info' => 'A12',
            'price' => 99.99,
            'user_id' => $userId,
            'event_id' => 1
        ]);

        Ticket::create([
            'seat_info' => 'B34',
            'price' => 49.99,
            'user_id' => $userId,
            'event_id' => 2
        ]);
    }
}
