<?php

use Illuminate\Database\Seeder;

class CompetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Competition::create([
            'channel_id' => \App\Channel::inRandomOrder()->first()->id,
            'start_at' => today()->setTime(22, 0, 0),
            'end_at' => today()->setTime(22, 15, 0),
            'description' => 'Lorem Ipsum'
        ]);
    }
}
