<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Board\StoreRequest;
use App\Http\Requests\Board\UpdateRequest;
use App\Http\Resources\Board\ShowResource;
use App\Http\Resources\Board\StoreResource;
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


        Board::insert((new BoardService())->generateBoard($game->id));

        return new StoreResource($request);
    }

    public function update(UpdateRequest $request)
    {

        $square = Board::where('id', $request->square_id)
            ->where('game_id', $request->game_id)
            ->firstOrFail();
        $square->isX = $request->isX;
        $square->save();

        return new ShowResource($square);
    }


}
