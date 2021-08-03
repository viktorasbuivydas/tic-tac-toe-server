<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Board\StoreRequest;
use App\Http\Requests\Board\UpdateRequest;
use App\Http\Resources\Board\ShowResource;
use App\Models\Board;
use App\Models\Game;
use App\Services\BoardService;

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

    public function update(UpdateRequest $request)
    {
        $game = Game::where('uid', $request->uid)->select('id')->firstOrFail();
        $square = Board::where('id', $request->square_id)
            ->where('game_id', $game->id)
            ->firstOrFail();
        $square->isX = $request->isX;
        $square->save();

        return new ShowResource($square);
    }


}
