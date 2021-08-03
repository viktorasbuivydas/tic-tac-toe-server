<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
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
            'id' => $this->id,
            'uid' => $this->uid,
            'squares' => SquareResource::collection($this->squares),
            'logs' => LogResource::collection($this->logs),
            'isPlayerXTurn' => $this->lastAction === null ? true : ($this->lastAction->isX === false ? true : false),
            'isFinished' => $this->isFinished
        ];
    }
}
