<?php

namespace App\Console\Commands;

use App\StatisticMonthly;
use Illuminate\Console\Command;

class CreateMonthlyStatSalaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:create-monthly-salaries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create monthly statistics from Salaries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new StatisticMonthly)->callSalaries();
    }
}
