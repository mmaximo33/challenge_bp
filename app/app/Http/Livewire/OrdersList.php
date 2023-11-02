<?php

namespace App\Http\Livewire;

use App\Models\Orders;
use Livewire\Component;

class OrdersList extends Component
{
    public $orders;
    public function render()
    {
        $this->orders = Orders::with('ordersLines.product')->get();

        return view('livewire.orders-list');
    }
}
