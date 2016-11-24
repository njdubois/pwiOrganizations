<?php

use Illuminate\Database\Seeder;

class CausesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('causes')->insert([
            'title' => "Water",
        ]);

        DB::table('causes')->insert([
            'title' => "Animals",
        ]);

        DB::table('causes')->insert([
            'title' => "Health",
        ]);

        DB::table('causes')->insert([
            'title' => "Care",
        ]);

        DB::table('causes')->insert([
            'title' => "Joy",
        ]);

        DB::table('causes')->insert([
            'title' => "Sun",
        ]);
    }
}
