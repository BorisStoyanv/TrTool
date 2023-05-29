<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; // Make sure you import your User model here
use Carbon\Carbon;

class ResetProfitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profit:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user profit every day';

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
        User::query()->where('last_played_at', '<', Carbon::today())->update(['profit' => 0]);
        $this->info('Profit reset successfully.');
    }
}
