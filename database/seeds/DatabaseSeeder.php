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
        $this->call(SourcerorTableSeeder::class);
        $this->call(ResourceTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(AssetTableSeeder::class);
    }
}
