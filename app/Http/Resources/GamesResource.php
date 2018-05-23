<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GamesResource extends JsonResource
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
            'mode' => $this->mode->text,
            'channel' => $this->channel->name,
            'scores' => $this->scores,
            'words_solved_count' => $this->histories()->count(),
            'human_time' => $this->created_at->diffForHumans(),
            'histories' => $this->histories
        ];
    }
}
