<?php

namespace App\Console\Commands;

use App\Models\PlayerImportData;
use Illuminate\Console\Command;
use App\Integrations\PlayerStatsInterface;

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
    public function handle(PlayerStatsInterface $client)
    {
        PlayerImportData::truncate();
        $playerStatsCollection = collect(json_decode($client->fetchPlayerStats()));

        $progressTotal = round($playerStatsCollection->count() / 100) + 1;

        $bar = $this->output->createProgressBar($progressTotal);
        $bar->start();

        $chunks = $playerStatsCollection->chunk(100);

        $chunks->map(function($chunk) use ($bar) {
            $chunk->map(function($player) {
                PlayerImportData::create([
                    'reference_id' => $player->id,
                    'data' => $player,
                ]);
            });

            $bar->advance();
        });

        $bar->finish();

        $this->info(PHP_EOL . 'Successfully imported player stats!');
    }
}
