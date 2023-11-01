<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\OrdersLines;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersLinesFactory extends Factory
{

    protected $model = OrdersLines::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'  => Orders::inRandomOrder()->first()->id,
            'qty'       => $this->faker->numberBetween(1,100),
            'product_id'=> Products::inRandomOrder()->first()->id
        ];
    }
}
