<?php

namespace Tests\Unit;

use App\Models\Board;
use App\Models\Game;
use App\Services\BoardService;
use App\Services\GameService;
use PHPUnit\Framework\TestCase;

class WinnerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_row_winner_x()
    {
        /*
         * x | x | x
         * o | o | -
         * - | 0 | -
         */
        $board = [
            ['x' => 1, 'y' => 1, 'isX' => true],
            ['x' => 2, 'y' => 1, 'isX' => true],
            ['x' => 3, 'y' => 1, 'isX' => true],
            ['x' => 1, 'y' => 2, 'isX' => false],
            ['x' => 2, 'y' => 2, 'isX' => false],
            ['x' => 3, 'y' => 2, 'isX' => null],
            ['x' => 1, 'y' => 3, 'isX' => null],
            ['x' => 2, 'y' => 3, 'isX' => false],
            ['x' => 3, 'y' => 3, 'isX' => null],
        ];
        $boardService = new BoardService();
        $winner = $boardService->findWinnerSquares($board);
        $this->assertEquals(json_encode($winner), json_encode(
            [
                'isFinished' => true,
                'winnerSquares' => [0, 1, 2],
                'isWinnerX' => true
            ]
        ));
    }

}
