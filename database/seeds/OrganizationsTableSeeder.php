<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => "Wellspring of Hope",
            'logo_filename' => "Logo_1.jpg",
            'established' => "2015-01-01",
            "revenue_id" => "1"
        ]);

        DB::table('organizations')->insert([
            'name' => "Ignite",
            'logo_filename' => "Logo_2.jpg",
            'established' => "2015-05-11",
            "revenue_id" => "2"
        ]);

    }
}
