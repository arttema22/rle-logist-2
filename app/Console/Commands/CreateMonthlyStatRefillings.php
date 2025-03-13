<?php

namespace App\Console\Commands;

use App\StatisticMonthly;
use Illuminate\Console\Command;

class CreateMonthlyStatRefillings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:create-monthly-refillings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly statistics from Refillings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new StatisticMonthly)->callRefillings();
    }
}
