<?php

use Illuminate\Database\Seeder;

class CauseOrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cause_organization')->insert([
            'organization_id' => "1",
            'cause_id' => "1"
        ]);

        DB::table('cause_organization')->insert([
            'organization_id' => "1",
            'cause_id' => "3"
        ]);

        DB::table('cause_organization')->insert([
            'organization_id' => "2",
            'cause_id' => "4"
        ]);

        DB::table('cause_organization')->insert([
            'organization_id' => "2",
            'cause_id' => "1"
        ]);
    }
}
