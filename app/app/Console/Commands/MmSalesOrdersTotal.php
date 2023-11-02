<?php

namespace App\Console\Commands;

use App\Jobs\SalesOrdersTotalJobs;
use App\Models\Orders;
use App\Models\OrdersLines;
use Illuminate\Console\Command;

class MmSalesOrdersTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mm:salesorders:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate the total amount of sales made';

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
     * @return int
     */
    public function handle()
    {
        dispatch(new SalesOrdersTotalJobs());
    }

    /**
     * Calculate sales orders total
     *
     * @return mixed
     */
    private function salesTotal(){
        return Orders::salesTotal();
    }


}
