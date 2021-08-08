<?php

namespace App\Http\Resources\Game;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'game_uid' => $this->uid,
            'is_player_x_turn' => $this->lastAction === null ? true : ($this->lastAction->isX === false ? true : false),
            'is_finished' => $this->isFinished,
            'winner_moves' => $this->winner_moves
        ];
    }
}
