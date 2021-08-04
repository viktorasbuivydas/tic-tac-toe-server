<?php

namespace App\Http\Resources\Action;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'isX' => $this->isX,
            'game_uid' => $this->game_uid,
        ];
    }
}
