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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(OrganisationTableSeeder::class);
        $this->call(FreelancerTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
    }
}
