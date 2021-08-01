<?php

namespace Tests\Unit;

use App\Models\Board;
use App\Models\Game;
use App\Services\BoardService;
use App\Services\GameService;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generate_uid()
    {
        $game_uid = (new GameService())->generateUid();
        $this->assertIsString($game_uid);
    }
    public function test_generate_empty_game_board(){

        $game_id = 1;
        $board = (new BoardService())->generateBoard($game_id);
        $data = [
            ['x' => 1, 'y' => 1, 'game_id' => $game_id,],
            ['x' => 2, 'y' => 1, 'game_id' => $game_id,],
            ['x' => 3, 'y' => 1, 'game_id' => $game_id,],
            ['x' => 1, 'y' => 2, 'game_id' => $game_id,],
            ['x' => 2, 'y' => 2, 'game_id' => $game_id,],
            ['x' => 3, 'y' => 2, 'game_id' => $game_id,],
            ['x' => 1, 'y' => 3, 'game_id' => $game_id,],
            ['x' => 2, 'y' => 3, 'game_id' => $game_id,],
            ['x' => 3, 'y' => 3, 'game_id' => $game_id,],
        ];

        $this->assertEquals($data, $board);
    }
}
