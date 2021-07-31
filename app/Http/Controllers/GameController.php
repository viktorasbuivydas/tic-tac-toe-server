<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Models\Board;
use App\Models\Game;
use Illuminate\Support\Str;

class GameController extends Controller
{
    public function create(){

        $uid = Str::uuid()->toString();
        $game = Game::create(['uid' => $uid]);

        Board::insert($this->generateBoard($game->id));
        return $game->uid;

    }

    public function show($uid){

        return new GameResource(Game::where('uid', $uid)->firstOrFail());

    }

    private function generateBoard($game_id){

        $board = [];
        for($y = 1; $y <= 3; $y++){
            for($x = 1; $x <= 3; $x++){
                array_push($board, ['x' => $x, 'y' => $y, 'game_id' => $game_id]);
            }
        }
        return $board;

    }
}
