<?php

namespace Database\Seeders;

use App\Models\Reserve;
use App\Models\Service;
use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'out_side',
            'price' => 25,
            'time' => 15
        ]);
        Service::create([
            'name' => 'in_side',
            'price' => 30,
            'time' => 20
        ]);
        Service::create([
            'name' => 'master',
            'price' => 80,
            'time' => 60
        ]);

        \App\Models\User::create([
            'name' => 'reza',
            'phone' => '09185465778',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'admin' => true
        ]);

        \App\Models\User::factory(10)->create();
        Station::create([
            'name' => 'station1',
        ]);
        Station::create([
            'name' => 'station2',
        ]);

        Reserve::create([
            'user_id' => 2,
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '09:00 AM',
            'exit_time' => '10:00 AM'
        ]);

        Reserve::create([
            'user_id' => 2,
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '10:15 AM',
            'exit_time' => '10:35 AM'
        ]);

        Reserve::create([
            'user_id' => 3,
            'track_code' => uniqid(),
            'price' => 25,
            'service' => 'out_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '11:00 AM',
            'exit_time' => '11:15 AM'
        ]);

        Reserve::create([
            'user_id' => 4,
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '12:30 PM',
            'exit_time' => '12:50 PM'
        ]);

        
        Reserve::create([
            'user_id' => 5,
            'track_code' => uniqid(),
            'price' => 25,
            'service' => 'out_side',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '12:30 PM',
            'exit_time' => '12:45 PM'
        ]);

        Reserve::create([
            'user_id' => 6,
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '01:00 PM',
            'exit_time' => '01:20 PM'
        ]);


        Reserve::create([
            'user_id' => 7,
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '09:30 AM',
            'exit_time' => '10:30 AM'
        ]);

        Reserve::create([
            'user_id' => 8,
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 1,
            'day' => date('Y-m-d', strtotime('+1 day')),
            'open_time' => '09:30 AM',
            'exit_time' => '10:30 AM'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
