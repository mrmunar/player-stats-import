<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PlayerStatsImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats_import:players';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import player stats from Premierleague API';

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
     * @return mixed
     */
    public function handle()
    {
        // add integration api
        // add array chunk
        // add job to save in database
    }
}
