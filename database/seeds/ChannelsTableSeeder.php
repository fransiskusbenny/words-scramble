<?php

use App\Channel;
use Illuminate\Database\Seeder;


class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        $tables = [
            'channels',
            'words',
            'scramble_words'
        ];

        foreach ($tables as $table) {
            \Illuminate\Support\Facades\DB::table($table)->truncate();
        }

        $this->colors();
        $this->countries();

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }

    protected function colors()
    {
        $faker = \Faker\Factory::create();

        $channel = Channel::create([
            'name' => 'Colors',
            'description' => 'Lorem Ipsum'
        ]);

        foreach (range(1, 20) as $v) {
            $channel->words()->create([
                'mode_id' => \App\Mode::inRandomOrder()->first()->id,
                'text' => $faker->unique()->colorName,
                'hint' => $faker->sentence,
            ]);
        }
    }

    protected function countries()
    {
        $faker = \Faker\Factory::create();

        $channel = Channel::create([
            'name' => 'Countries',
            'description' => $faker->sentence
        ]);

        foreach (range(1, 20) as $v) {
            $channel->words()->create([
                'mode_id' => \App\Mode::inRandomOrder()->first()->id,
                'text' => $faker->unique()->country,
                'hint' => $faker->paragraph,
            ]);
        }
    }
}
