<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Action\StoreRequest;
use App\Http\Resources\Action\ShowResource;
use App\Models\Action;
use App\Models\Game;

class ActionController extends Controller
{
    public function store(StoreRequest $request)
    {
        $game = Game::where('uid', $request->game_uid)->firstOrFail();
        $action = $game->actions()->create($request->validated());

        return new ShowResource($action);
    }
}
