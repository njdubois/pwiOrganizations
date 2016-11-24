<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CausesTableSeeder::class);
        $this->call(RevenuesTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(CauseOrganizationTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
