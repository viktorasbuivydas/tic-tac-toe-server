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
            'is_finished' => false,
            'winning_moves' => [],
            'is_winner_x' => null
        ];
        $score = 0;

        for ($player = 1; $player <= 2; $player++) {
            $isPlayerX = $player === 1;
            for ($i = 0; $i < count($winningMoves); $i++) {
                for ($j = 0; $j < count($winningMoves[$i]); $j++) {
                    if ($board[$winningMoves[$i][$j]]['is_x'] === $isPlayerX) {
                        $score++;
                        if ($score === 3) {
                            $winner['is_finished'] = true;
                            $winner['winning_moves'] = $winningMoves[$i];
                            $winner['is_winner_x'] = $isPlayerX;
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
        if ($winner['is_finished'] !== true) {

            // draw
            $score = 0;
            for ($i = 0; $i < count($board); $i++) {
                if ($board[$i]['is_x'] !== null) {
                    $score++;
                }
            }
            if ($score === 9) {
                $winner['is_finished'] = true;
                $winner['winning_moves'] = null;
                $winner['is_winner_x'] = null;
            }

        }
        return $winner;
    }
}
