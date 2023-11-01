<?php

namespace App\Console\Commands;

use App\Models\Orders;
use App\Models\Products;
use App\Models\OrdersLines;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class MmDataExample extends Command
{
    CONST EXCEPTION_NOTFOUND_TABLE = '1146';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mm:data:example';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sample data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->existsTable();

            $results        = $this->resultsAsks();
            $qtyProducts    = $results['qtyProducts'];
            $qtyOrders      = $results['qtyOrders'];
            $qtyOrdersLines = $results['qtyOrdersLines'];
            $this->loadData($qtyProducts, $qtyOrders, $qtyOrdersLines);

            $this->info('The data was loaded successfully.');
            $this->table(
                ['Products', 'Orders', 'Order Lines'],
                [[$qtyProducts, $qtyOrders, $qtyOrdersLines]]
            );
        }catch (\Exception $e){
            if($e->getCode() == self::EXCEPTION_NOTFOUND_TABLE){
                Artisan::call('migrate');
                $this->handle();
            }else{
                $this->error(sprintf(
                    "Sql Error %s: %s",
                    $e->getCode(),
                    $e->getMessage()
                ));
            }
        }
    }

    /**
     * Asks and collect results
     *
     * @return array|int[]
     */
    private function resultsAsks(){
        $qtyProducts = $qtyOrders = $qtyOrdersLines = 0;

        $questions = [
            'How many products do you want to create?'      => &$qtyProducts,
            'How many orders do you want to create?'        => &$qtyOrders,
            'How many order lines do you want to create?'   => &$qtyOrdersLines,
        ];

        foreach ($questions as $question => &$quantity) {
            $isValid = false;
            while (!$isValid) {
                $input = $this->ask($question);
                if ($input >= 0 &&
                    filter_var($input, FILTER_VALIDATE_INT)!== false
                ){
                    $quantity = (int) $input;
                    $isValid = true;
                } else {
                    $this->error(
                        'Please enter a valid not negative integer.'
                    );
                }
            }
        }

        return [
            'qtyProducts'       => &$qtyProducts,
            'qtyOrders'         => &$qtyOrders,
            'qtyOrdersLines'    => &$qtyOrdersLines
        ];
    }

    /**
     * Validate database tables
     *
     * @return void
     * @throws \Exception
     */
    private function existsTable(){
        $tables = [
            (new Products())->getTable(),
            (new Orders())->getTable(),
            (new OrdersLines())->getTable()
        ];
        foreach($tables as $table){
            if (!Schema::hasTable($table)){
                throw new \Exception(
                    sprintf("Table %s does not exist.",$table),
                    self::EXCEPTION_NOTFOUND_TABLE
                );
            }
        }
    }

    /**
     * Load data example
     *
     * @param int $qtyProducts
     * @param int $qtyOrders
     * @param int $qtyOrderLines
     * @return void
     */
    private function loadData(
        int $qtyProducts    = 10,
        int $qtyOrders      = 20,
        int $qtyOrderLines  = 50
    )
    {
        Products::factory($qtyProducts)->create();
        Orders::factory($qtyOrders)->create();
        OrdersLines::factory($qtyOrderLines)->create();
    }
}

