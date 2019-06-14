<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = factory(Warehouse::class)->create();
    }
}
