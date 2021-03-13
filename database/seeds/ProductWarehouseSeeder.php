<?php

use Illuminate\Database\Seeder;
use App\ProductWarehouse;

class ProductWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_warehouses = factory(ProductWarehouse::class, 10)->create();
    }
}
