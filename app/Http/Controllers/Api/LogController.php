<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Log\StoreRequest;
use App\Http\Resources\Log\ShowResource;
use App\Models\Game;
use App\Models\Log;

class LogController extends Controller
{
    public function store(StoreRequest $request)
    {
        $player = $request->isX ? 'X' : 'O';
        $log_text = 'Player put ' . $player . ' on this square: x: ' . $request->x . ' y: ' . $request->y;
        $game = Game::where('uid', $request->game_uid)->firstOrFail();
        $log = $game->logs()->create([
            'log' => $log_text
        ]);

        return new ShowResource($log);
    }
}
