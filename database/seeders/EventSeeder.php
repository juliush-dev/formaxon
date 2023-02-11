<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $events = [
            [
                'name' => 'Tech Conference 2023',
                'target' => Event::TARGET_COMPANY,
                'description' => 'A two-day conference on the latest technology trends',
                'location' => 'San Francisco, CA',
                'at' => Carbon::create(2023, 5, 1, 9, 0, 0),
            ],
            [
                'name' => 'Music Festival 2023',
                'target' => Event::TARGET_VISITOR,
                'description' => 'A three-day music festival featuring various genres',
                'location' => 'Los Angeles, CA',
                'at' => Carbon::create(2023, 7, 15, 12, 0, 0),
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}