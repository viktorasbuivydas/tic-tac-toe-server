<?php

namespace App\Services;

class BoardService
{

    public function generateBoard($game_id)
    {
        $board = [];
        for ($y = 1; $y <= 3; $y++) {
            for ($x = 1; $x <= 3; $x++) {
                array_push($board, ['x' => $x, 'y' => $y, 'game_id' => $game_id]);
            }
        }
        return $board;
    }

    public function findWinnerSquares($board)
    {
        $winningMoves = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
            //columns
            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],
            //diagnol
            [0, 4, 8],
            [2, 4, 6],
        ];
        $winner = [
            'isFinished' => null,
            'winnerSquares' => null,
            'isWinnerX' => null
        ];
        $score = 0;

        for ($player = 1; $player <= 2; $player++) {
            $isPlayerX = $player === 1;
            for ($i = 0; $i < count($winningMoves); $i++) {
                for ($j = 0; $j < count($winningMoves[$i]); $j++) {
                    if ($board[$winningMoves[$i][$j]]['isX'] === $isPlayerX) {
                        $score++;
                        if ($score === 3) {
                            $winner['isFinished'] = true;
                            $winner['winnerSquares'] = $winningMoves[$i];
                            $winner['isWinnerX'] = $isPlayerX;
                            break;
                        }
                        continue;
                    } else {
                        $score = 0;
                        break;
                    }
                }
            }

        }
        if ($winner['isFinished'] !== true) {

            // draw
            $score = 0;
            for ($i = 0; $i < count($board); $i++) {
                if ($board[$i]['isX'] !== null) {
                    $score++;
                }
            }
            if ($score === 9) {
                $winner['isFinished'] = true;
                $winner['winnerSquares'] = null;
                $winner['isWinnerX'] = null;
            }

        }
        return $winner;
    }
}
