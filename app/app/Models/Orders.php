<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_ref',
        'customer_name',
    ];

    /**
     * One to Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLines::class);
    }

    /**
     * Calculate total sales
     * @return mixed
     */
    public function salesTotal(){
    //         // CHECK
    //         SELECT SUM(orders_lines.qty * products.cost) AS aggregate FROM `orders_lines` INNER JOIN `products` ON `orders_lines`.`product_id` = `products`.`id`;
    //
    //        $totalsql = OrdersLines::join('products', 'orders_lines.product_id', '=', 'products.id')
    //            ->selectRaw('sum(orders_lines.qty * products.cost) as totalCost')
    //            ->get();
    //        $totalCost = $totalsql[0]->totalCost;

        return OrdersLines::with('product')
            ->get()
            ->sum(function ($orderLines) {
            return $orderLines->qty * $orderLines->product->cost;
        });
    }
}
