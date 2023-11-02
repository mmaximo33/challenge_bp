<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'cost'
    ];

    /**
     * One to many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersLines()
    {
        return $this->hasMany(OrdersLines::class,'product_id');
    }
}
