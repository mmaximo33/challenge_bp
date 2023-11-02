<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersLines extends Model
{
    use HasFactory;

    protected $table = 'orders_lines';

    protected $fillable = [
        'order_id',
        'qty',
        'product_id'
    ];

    /**
     * Many to on
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /**
     * Many to on
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
