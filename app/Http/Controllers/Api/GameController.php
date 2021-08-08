<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Game\ShowResource;
use App\Http\Resources\Game\StoreResource;
use App\Models\Game;
use App\Services\GameService;
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

        return new StoreResource($game);
    }

    //update game status if game is over
    public function update($uid)
    {
        $game = Game::where('uid', $uid)->firstOrFail();
        $game_board = $game->squares()->get();

        $winner_squares = (new BoardService())->findWinnerSquares($game_board);

        if ($winner_squares['isFinished'] !== null) {
            $game->isFinished = $winner_squares['isFinished'];
            $game->save();
        }

        return $winner_squares;
    }
}
