<?php

use Illuminate\Database\Seeder;

class RevenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('revenues')->insert([
            'title' => "< $1 Million"
        ]);


        DB::table('revenues')->insert([
            'title' => "$1 - $1.5 Million"
        ]);


        DB::table('revenues')->insert([
            'title' => "$1.5 - $2 Million"
        ]);


        DB::table('revenues')->insert([
            'title' => "$2 - $2.5 Million"
        ]);


        DB::table('revenues')->insert([
            'title' => "> $2.5 Million"
        ]);

    }
}
