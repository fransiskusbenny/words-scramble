<?php

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
        $this->call(UsersTableSeeder::class);
        $this->call(ModesTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(CompetitionsTableSeeder::class);
        $this->call(GamesTableSeeder::class);
    }
}
