<?php

use Illuminate\Database\Seeder;

class ModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        \Illuminate\Support\Facades\DB::table('modes')->truncate();

        $faker = \Faker\Factory::create();
        $modes = [
            [
                'text' => 'Easy',
                'description' => $faker->paragraph,
            ],
            [
                'text' => 'Hard',
                'description' => $faker->paragraph,
            ],
            [
                'text' => 'Challenger',
                'description' => $faker->paragraph,
            ]
        ];

        foreach ($modes as $mode) {
            \App\Mode::create($mode);
        }

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
    }
}
