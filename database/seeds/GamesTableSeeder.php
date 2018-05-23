<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)
            ->create()
            ->each(function($user) {
//                Normal Games
                foreach (range(3, rand(5, 10)) as $value) {
                    $faker = \Faker\Factory::create();
                    $game = $user->games()->create([
                        'mode_id' => \App\Mode::inRandomOrder()->first()->id,
                        'channel_id' => \App\Channel::inRandomOrder()->first()->id,
                        'scores' => rand(300, 800),
                        'durations' => rand(6000, 9000),
                        'created_at' => $faker->dateTimeThisMonth
                    ]);

                    $words = [];

                    foreach (range(1, 20) as $value) {
                        $words[] = [
                            'solved_word' => $faker->word,
                            'points' => rand(50, 75)
                        ];
                    }

                    $game->histories()->createMany($words);
                }
            });
    }
}
