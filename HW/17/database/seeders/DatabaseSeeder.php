<?php

namespace Database\Seeders;

use App\Models\Reserve;
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
        Station::create([
            'name' => 'station1',
        ]);
        Station::create([
            'name' => 'station2',
        ]);

        Reserve::create([
            'name' => 'reza',
            'phone' => '09185465778',
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '09:00 AM',
            'exit_time' => '10:00 AM'
        ]);

        Reserve::create([
            'name' => 'taha',
            'phone' => '09181112222',
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '10:15 AM',
            'exit_time' => '10:35 AM'
        ]);

        Reserve::create([
            'name' => 'ramin',
            'phone' => '09182221111',
            'track_code' => uniqid(),
            'price' => 25,
            'service' => 'out_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '11:00 AM',
            'exit_time' => '11:15 AM'
        ]);

        Reserve::create([
            'name' => 'rasol',
            'phone' => '09183335778',
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 1,
            'day' => date('Y-m-d'),
            'open_time' => '12:30 PM',
            'exit_time' => '12:50 PM'
        ]);

        
        Reserve::create([
            'name' => 'amir',
            'phone' => '09184345778',
            'track_code' => uniqid(),
            'price' => 25,
            'service' => 'out_side',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '12:30 PM',
            'exit_time' => '12:45 PM'
        ]);

        Reserve::create([
            'name' => 'arad',
            'phone' => '09188885778',
            'track_code' => uniqid(),
            'price' => 30,
            'service' => 'in_side',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '01:00 PM',
            'exit_time' => '01:20 PM'
        ]);


        Reserve::create([
            'name' => 'asad',
            'phone' => '09186661111',
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 2,
            'day' => date('Y-m-d'),
            'open_time' => '09:30 AM',
            'exit_time' => '10:30 AM'
        ]);

        Reserve::create([
            'name' => 'amin',
            'phone' => '09187777111',
            'track_code' => uniqid(),
            'price' => 80,
            'service' => 'master',
            'station_id' => 1,
            'day' => date('Y-m-d', strtotime('+1 day')),
            'open_time' => '09:30 AM',
            'exit_time' => '10:30 AM'
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
