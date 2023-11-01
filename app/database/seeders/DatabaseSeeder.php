<?php

namespace Database\Seeders;

use App\Models\OrdersLines;
use Illuminate\Database\Seeder;
use App\Models\Orders;
use App\Models\Products;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Products::factory(10)->create();
        Orders::factory(20)->create();
        OrdersLines::factory(50)->create();
    }
}
