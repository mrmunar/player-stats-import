<?php

namespace Tests\Feature\Http\Controllers;

use Tests\WithDatabaseTestCase;

class PlayerStatsControllerTest extends WithDatabaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetPlayersApiSuccess()
    {
        $data = factory('App\Models\PlayerImportData', 5)->create();

        $data = $data->map(function($player){
            return json_decode($player->data, JSON_OBJECT_AS_ARRAY);
        });

        $response = $this->get(route('stats.players.index'));

        $response
            ->assertStatus(200)
            ->assertJson($data->toArray());
        $this->assertEquals(count($response->json()), 5);
    }

    public function testGetPlayersApiSimpleModeSuccess()
    {
        $data = factory('App\Models\PlayerImportData', 5)->create();

        $response = $this->get(route('stats.players.index') . '?mode=simple');

        $response->assertStatus(200)
            ->assertJsonStructure([['id', 'full_name']]);
        $this->assertEquals(count($response->json()), 5);
    }

    public function testGetPlayerApiSuccess()
    {
        $data = factory('App\Models\PlayerImportData', 5)->create();

        $data = $data->map(function($player){
            return json_decode($player->data, JSON_OBJECT_AS_ARRAY);
        })->first(function($player){
            return $player['id'] === 3;
        });

        $response = $this->get(route('stats.players.show', ['id' => 3]));

        $response
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function testGetPlayerApiInvalidIdFailure()
    {
        factory('App\Models\PlayerImportData', 5)->create();

        $response = $this->get(route('stats.players.show', ['id' => 'abc123']));

        $response->assertStatus(404);
    }
}
