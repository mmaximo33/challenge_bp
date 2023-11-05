<?php

namespace App\Http\Livewire;

use App\Models\Orders;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class OrdersList extends Component
{
    const ASCENDING = 'asc', DESCENDING = 'desc';

    // Simulacion datos configurados en db
    const SORT_CONFIG = ['element' => 'id', 'type' => self::DESCENDING];
    const ITEMS_PER_PAGE_CONFIG = [
        'default'=> 10,
        'items'=> [5, 10, 15, 20, 100]
    ];

    use WithPagination;

    private $orders;
    protected $queryString = [
        'searchFields'  => ['except' => ''],
        'sortType'      => ['except' => self::SORT_CONFIG['type']],
        'sortElement'   => ['except' => self::SORT_CONFIG['element']],
        'itemsPerPage'  => ['except' => self::ITEMS_PER_PAGE_CONFIG['default']],
    ];

    public
        $searchFields = '',
        $itemsPerPage = self::ITEMS_PER_PAGE_CONFIG['default'],
        $itemsPerPageList = self::ITEMS_PER_PAGE_CONFIG['items'],
        $sortElement = self::SORT_CONFIG['element'],
        $sortType = self::SORT_CONFIG['type'];

    /**
     * Reder
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $searchTerm = '%' . $this->searchFields . '%';

        $this->orders = Orders::select(
                'orders.id as id',
                'order_ref',
                'customer_name',
                'products.name as product_name',
                'orders_lines.qty AS qty',
                DB::raw('CONCAT("$ ", FORMAT(products.cost, 2)) AS cost'),
                DB::raw('CONCAT("$ ", FORMAT(orders_lines.qty * products.cost, 2)) AS total_cost')
            )
            ->join('orders_lines', 'orders.id', '=', 'orders_lines.order_id')
            ->join('products', 'orders_lines.product_id', '=', 'products.id')
            ->where(function ($query) use ($searchTerm) {
                $query->where('customer_name', 'like', $searchTerm)
                    ->orWhere('orders.order_ref', 'like', $searchTerm)
                    ->orWhere('products.name', 'like', $searchTerm);
            })
            ->orderBy($this->sortElement, $this->sortType)
            ->paginate($this->itemsPerPage);

        return view('livewire.orders-list', [
            'orders' => $this->orders
        ]);
    }

    /**
     * SortClick Action
     *
     * @param $element
     * @return void
     */
    public function sortClick($element){
        if ($this->sortElement === $element) {
            $this->sortType = ($this->sortType === self::DESCENDING) ? self::ASCENDING : self::DESCENDING;
        } else {
            $this->sortElement = $element;
            $this->sortType = self::ASCENDING;
        }
    }

    /**
     * Required pagination
     *
     * @return void
     */
    public function updatingSearchFields(){

    }
}
