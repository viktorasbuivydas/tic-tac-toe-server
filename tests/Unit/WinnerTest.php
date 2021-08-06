<?php

namespace Tests\Unit;

use App\Models\Board;
use App\Models\Game;
use App\Services\BoardService;
use App\Services\GameService;
use PHPUnit\Framework\TestCase;

class WinnerTest extends TestCase
{

    public function test_row_winner_x()
    {
        /*
         * x | x | x
         * o | o | -
         * - | 0 | -
         */
        $this->testBoard([
            0 => true,
            1 => true,
            2 => true,
            3 => false,
            4 => false,
            7 => false
        ], true, [0, 1, 2], true);
    }

    public function test_row_winner_o()
    {
        /*
         * x | x | -
         * o | o | o
         * - | 0 | -
         */
        $this->testBoard([
            0 => true,
            1 => true,
            3 => false,
            4 => false,
            5 => false,
            7 => false
        ], true, [3, 4, 5], false);
    }

    public function test_draw()
    {
        /*
         * x | x | o
         * o | o | x
         * x | 0 | o
         */
        $this->testBoard([
            0 => true,
            1 => true,
            2 => false,
            3 => false,
            4 => false,
            5 => true,
            6 => true,
            7 => true,
            8 => false,

        ], true, null, null);
    }

    public function test_column_winner_x()
    {
        /*
         * x | x | o
         * o | x | x
         * x | x | o
         */
        $this->testBoard([
            0 => true,
            1 => true,
            2 => false,
            3 => false,
            4 => true,
            5 => true,
            6 => true,
            7 => true,
            8 => false,

        ], true, [1, 4, 7], true);
    }

    public function test_column_winner_o()
    {
        /*
         * x | x | o
         * o | x | o
         * x | o | o
         */
        $this->testBoard([
            0 => true,
            1 => true,
            2 => false,
            3 => false,
            4 => true,
            5 => false,
            6 => true,
            7 => false,
            8 => false,

        ], true, [2, 5, 8], false);
    }

    public function test_diagnol_winner_o()
    {
        /*
         * x | x | o
         * x | o | o
         * o | o | x
         */
        $this->testBoard([
            0 => true,
            1 => true,
            2 => false,
            3 => true,
            4 => false,
            5 => false,
            6 => false,
            7 => false,
            8 => true,

        ], true, [2, 4, 6], false);
    }

    private function testBoard($squares, $isFinished, $winnerSquares, $isWinnerX)
    {
        $board = [
            ['x' => 1, 'y' => 1, 'isX' => null],
            ['x' => 2, 'y' => 1, 'isX' => null],
            ['x' => 3, 'y' => 1, 'isX' => null],
            ['x' => 1, 'y' => 2, 'isX' => null],
            ['x' => 2, 'y' => 2, 'isX' => null],
            ['x' => 3, 'y' => 2, 'isX' => null],
            ['x' => 1, 'y' => 3, 'isX' => null],
            ['x' => 2, 'y' => 3, 'isX' => null],
            ['x' => 3, 'y' => 3, 'isX' => null],
        ];
        if ($squares !== null) {
            foreach ($board as $key => $value) {
                foreach ($squares as $square_key => $square_value) {
                    if ($key === $square_key) {
                        $board[$square_key]['isX'] = $square_value;
                    }
                }
            }
        }
        $boardService = new BoardService();
        $winner = $boardService->findWinnerSquares($board);
        $this->assertEquals(json_encode($winner), json_encode(
            [
                'isFinished' => $isFinished,
                'winnerSquares' => $winnerSquares,
                'isWinnerX' => $isWinnerX
            ]));
    }
}
