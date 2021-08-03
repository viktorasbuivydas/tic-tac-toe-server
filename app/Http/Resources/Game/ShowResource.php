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
            'uid' => $this->uid,
            'isPlayerXTurn' => $this->lastAction === null ? true : ($this->lastAction->isX === false ? true : false),
            'isFinished' => $this->isFinished
        ];
    }
}
