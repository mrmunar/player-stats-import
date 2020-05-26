<?php

namespace Tests\Feature\Console\Commands;

use App\Integrations\PlayerStatsInterface;
use App\Models\PlayerImportData;
use Tests\TestCase;

class PlayerStatsImportTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testRunPlayerStatsImportCommandSuccess()
    {
        $this->mock(PlayerStatsInterface::class, function ($mock) {
            $mock->shouldReceive('fetchPlayerStats')->once()
                ->andReturn('[{"chance_of_playing_next_round":100,"chance_of_playing_this_round":100,"code":69140,"cost_change_event":0,"cost_change_event_fall":0,"cost_change_start":-4,"cost_change_start_fall":4,"dreamteam_count":0,"element_type":2,"ep_next":"0.0","ep_this":"0.0","event_points":0,"first_name":"Shkodran","form":"0.0","id":1,"in_dreamteam":false,"news":"","news_added":"2020-02-27T23:00:18.104137Z","now_cost":51,"photo":"69140.jpg","points_per_game":"3.2","second_name":"Mustafi","selected_by_percent":"0.4","special":false,"squad_number":null,"status":"a","team":1,"team_code":3,"total_points":26,"transfers_in":15418,"transfers_in_event":0,"transfers_out":38422,"transfers_out_event":0,"value_form":"0.0","value_season":"5.1","web_name":"Mustafi","minutes":620,"goals_scored":0,"assists":2,"clean_sheets":2,"goals_conceded":9,"own_goals":0,"penalties_saved":0,"penalties_missed":0,"yellow_cards":0,"red_cards":0,"saves":0,"bonus":1,"bps":144,"influence":"174.2","creativity":"15.4","threat":"107.0","ict_index":"29.8","influence_rank":289,"influence_rank_type":113,"creativity_rank":383,"creativity_rank_type":141,"threat_rank":246,"threat_rank_type":68,"ict_index_rank":330,"ict_index_rank_type":117},{"chance_of_playing_next_round":100,"chance_of_playing_this_round":100,"code":98745,"cost_change_event":0,"cost_change_event_fall":0,"cost_change_start":0,"cost_change_start_fall":0,"dreamteam_count":0,"element_type":2,"ep_next":"0.0","ep_this":"0.0","event_points":0,"first_name":"Héctor","form":"0.0","id":2,"in_dreamteam":false,"news":"","news_added":"2019-12-09T20:00:21.228098Z","now_cost":55,"photo":"98745.jpg","points_per_game":"3.1","second_name":"Bellerín","selected_by_percent":"1.2","special":false,"squad_number":null,"status":"a","team":1,"team_code":3,"total_points":25,"transfers_in":141114,"transfers_in_event":0,"transfers_out":74300,"transfers_out_event":0,"value_form":"0.0","value_season":"4.5","web_name":"Bellerín","minutes":623,"goals_scored":1,"assists":0,"clean_sheets":2,"goals_conceded":10,"own_goals":0,"penalties_saved":0,"penalties_missed":0,"yellow_cards":2,"red_cards":0,"saves":0,"bonus":3,"bps":116,"influence":"117.6","creativity":"37.7","threat":"38.0","ict_index":"19.5","influence_rank":328,"influence_rank_type":129,"creativity_rank":329,"creativity_rank_type":112,"threat_rank":338,"threat_rank_type":118,"ict_index_rank":366,"ict_index_rank_type":132},{"chance_of_playing_next_round":100,"chance_of_playing_this_round":100,"code":111457,"cost_change_event":0,"cost_change_event_fall":0,"cost_change_start":-3,"cost_change_start_fall":3,"dreamteam_count":0,"element_type":2,"ep_next":"0.0","ep_this":"0.0","event_points":0,"first_name":"Sead","form":"0.0","id":3,"in_dreamteam":false,"news":"","news_added":"2020-02-23T18:30:13.672943Z","now_cost":52,"photo":"111457.jpg","points_per_game":"2.1","second_name":"Kolasinac","selected_by_percent":"0.5","special":false,"squad_number":null,"status":"a","team":1,"team_code":3,"total_points":35,"transfers_in":55476,"transfers_in_event":0,"transfers_out":127776,"transfers_out_event":0,"value_form":"0.0","value_season":"6.7","web_name":"Kolasinac","minutes":1103,"goals_scored":0,"assists":2,"clean_sheets":2,"goals_conceded":19,"own_goals":0,"penalties_saved":0,"penalties_missed":0,"yellow_cards":3,"red_cards":0,"saves":0,"bonus":1,"bps":222,"influence":"190.0","creativity":"157.3","threat":"67.0","ict_index":"41.2","influence_rank":279,"influence_rank_type":110,"creativity_rank":195,"creativity_rank_type":47,"threat_rank":294,"threat_rank_type":93,"ict_index_rank":289,"ict_index_rank_type":101}]');
        });

        $this->mock(PlayerImportData::class, function ($mock) {
            $mock->shouldReceive('updateOrCreate');
        });

        $this->artisan('stats_import:players')
            ->expectsOutput(PHP_EOL . 'Successfully imported player stats!')
            ->assertExitCode(0);
    }
}
