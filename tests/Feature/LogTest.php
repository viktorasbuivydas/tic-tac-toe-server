<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    public function test_creating_new_log_with_not_existing_game()
    {
        $data = [
            'isX'=> true,
            'game_uid' => 'sfdsdf-fgsdfh-rfgsdfg',
            'x'=> 1,
            'y' => 1
            ];
        $response = $this->json('POST', '/api/logs', $data);
        $response->assertStatus(404);
    }


}
