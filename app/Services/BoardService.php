<?php

namespace App\Services;

class BoardService{

    public function generateBoard($game_id){
        $board = [];
        for($y = 1; $y <= 3; $y++){
            for($x = 1; $x <= 3; $x++){
                array_push($board, ['x' => $x, 'y' => $y, 'game_id' => $game_id]);
            }
        }
        return $board;
    }

    public function findWinnerSquares($board, $index){
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
            'isFinished' => false,
        ];
        $squareCount = 0;
        for ($i = 0; $i < count($winningMoves); $i++) {
            $squareCount = 0;
            for ($j = 0; $j < count($winningMoves[$i]); $j++) {
                $mySquare = $board[$index]->isX;
                if ($mySquare === $board[$winningMoves[$i][$j]]->isX) {
                    $squareCount++;
                } else {
                    break;
                }
            }
            if ($squareCount === 3) {
                $winner['isFinished'] = true;
                break;
            }
        }
        return $winner;
    }
}
