<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eticket.com'],
            ['name' => 'Admin', 'role' => 'admin', 'password' => 'password']
        );

        User::updateOrCreate(
            ['email' => 'user@eticket.com'],
            ['name' => 'Test User', 'role' => 'user', 'password' => 'password']
        );

        $event = Event::firstOrCreate(
            ['title' => 'Tech Conference 2025'],
            [
                'description' => 'Annual technology conference with keynote speakers.',
                'venue' => 'Convention Center',
                'event_date' => now()->addDays(30),
                'is_active' => true,
            ]
        );

        $event->ticketTypes()->firstOrCreate(
            ['event_id' => $event->id, 'name' => 'General Admission'],
            ['price' => 500, 'quantity' => 100]
        );
        $event->ticketTypes()->firstOrCreate(
            ['event_id' => $event->id, 'name' => 'VIP'],
            ['price' => 1500, 'quantity' => 20]
        );

        $this->call(ProductSeeder::class);
    }
}
