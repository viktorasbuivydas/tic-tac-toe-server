<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\UpdateRequest;
use App\Http\Resources\Game\ShowResource;
use App\Http\Resources\StoreResource;
use App\Http\Resources\GameResource;
use App\Models\Board;
use App\Models\Game;
use App\Services\GameService;
use Illuminate\Http\Request;
use App\Services\BoardService;

class GameController extends Controller
{


    public function show($uid)
    {
        return new ShowResource(Game::where('uid', $uid)->firstOrFail());

    }

    public function store()
    {

        $uid = (new GameService())->generateUid();
        $game = Game::create(['uid' => $uid]);

        return new ShowResource($game);
    }

    public function update(UpdateRequest $request)
    {

        $game = Game::where('uid', $request->uid)->firstOrFail();
        $board = Board::where('game_id', $game->id)->get();
        $winner_squares = (new BoardService())->findWinnerSquares($board, $request->index);
        $game->isFinished = $winner_squares['isFinished'];
        return new ShowResource($winner_squares);
    }
}
