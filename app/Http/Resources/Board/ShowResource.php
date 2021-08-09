<?php

namespace App\Http\Resources\Board;

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
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'is_x' => $this->is_x
        ];
    }
}
