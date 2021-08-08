<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_new_game()
    {
        $response = $this->json('POST', '/api/games');
        $response->assertStatus(201)
            ->assertJsonStructure(['data' => ['game_uid']]);
    }

}
