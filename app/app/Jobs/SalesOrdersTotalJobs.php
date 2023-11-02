<?php

namespace App\Jobs;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesOrdersTotalJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dd(sprintf(
            'El costo total de todas las órdenes es: %s',
            $this->salesTotal()
        ));
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
