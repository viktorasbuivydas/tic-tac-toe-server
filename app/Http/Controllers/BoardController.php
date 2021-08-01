<?php

namespace App\Http\Controllers;

use App\Http\Resources\SquareResource;
use App\Models\Action;
use App\Models\Board;
use App\Models\Game;
use App\Models\Log;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function show($uid){

        $game = Game::where('uid', $uid)->select('id')->firstOrFail();
        return Board::where('game_id', $game->id)->get();

    }
    public function playerMove(Request $request){

        $game = Game::where('id', $request->game_id)->firstOrFail();
        $game_id = $game->id;
        $square = Board::where('x', $request->x)
            ->where('y', $request->y)
            ->where('game_id', $game_id)
            ->firstOrFail();
        $square->isX = $request->isX;
        $square->save();

        Action::create([
            'isX' => $request->isX,
            'game_id' => $game_id
        ]);
        $player = $request->isX ? 'X' : 'O';
        $log = 'Player put '.$player.' on this square: x: '.$request->x.' y: '.$request->y;
        Log::create([
            'game_id' => $game_id,
            'log' => $log
        ]);
        return new SquareResource($square);
    }
}
