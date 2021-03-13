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
        $this->call(RoleSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductWarehouseSeeder::class);

        $this->command->info("All data created.");
    }
}
