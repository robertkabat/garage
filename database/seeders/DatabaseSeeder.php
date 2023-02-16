<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Robert Kabat',
            'email' => 'admin@pub.com',
            'password' => '$2a$12$IvX8hHUBJkjzLd4/E.hLF.CwmbdWl9P5ssEkU13ZWiI/Y.7PGdGTS', // password
            'email_verified_at' => now()
        ]);


        // get the data from the json file
        $timeSlots = json_decode(File::get('database/fixtures/time-slots.json'), true);
        foreach ($timeSlots as $slot) {
            TimeSlot::insert(['slot' => $slot['slot']]);
        }
    }
}
