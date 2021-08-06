<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Board\StoreRequest;
use App\Http\Resources\Board\ShowResource;
use App\Http\Resources\Board\UpdateResource;
use App\Models\Board;
use App\Models\Game;
use App\Services\BoardService;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function show($uid)
    {

        $game = Game::where('uid', $uid)->select('id')->firstOrFail();
        $board = $game->squares()->get();

        return ShowResource::collection($board);
    }

    public function store(StoreRequest $request)
    {
        $game = Game::where('uid', $request->uid)->select('id')->firstOrFail();
        $squares = Board::where('game_id', $game->id);
        $square_count = $squares->count();
        abort_if($square_count >= 9, 422, "game board already exists");
        Board::insert((new BoardService())->generateBoard($game->id));

        return ShowResource::collection($squares->get());
    }

    public function update(Request $request)
    {
        $uid = $request->uid;
        $game = Game::where('uid', $uid)->firstOrFail();

        $board = Board::where('id', $request->square_id)
            ->where('game_id', $game->id);
        $game_board = $game->squares()->get();

        $square = $board->firstOrFail();
        $square->isX = $request->isX;
        $square->save();

        $winner_squares = (new BoardService())->findWinnerSquares($game_board, $request->square_index);
        return $winner_squares;
        /*
        $game->isFinished = $winner_squares['isFinished'];
        $new_request = new Request();
        $new_request->uid = $uid;
        $new_request->isPlayerXTurn = $game->lastAction();
        $new_request->isFinished = $game->isFinished;
        $new_request->square = $square;

        return new UpdateResource($new_request);
        */
    }


}
