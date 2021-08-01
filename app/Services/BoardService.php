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
}
