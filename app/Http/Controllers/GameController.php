<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameCreateResource;
use App\Http\Resources\GameResource;
use App\Models\Board;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Support\Str;
use App\Services\BoardService;

class GameController extends Controller
{
    public function store(){

        $uid = (new GameService())->generateUid();
        $game = Game::create(['uid' => $uid]);
        Board::insert((new BoardService())->generateBoard($game->id));

        return new GameCreateResource($game);

    }

    public function show($uid){

        return new GameResource(Game::where('uid', $uid)->firstOrFail());

    }
}
