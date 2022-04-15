<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LeagueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'points' => $this->points,
            'played' => $this->played,
            'win' => $this->win,
            'lose' => $this->lose,
            'draw' => $this->draw,
            'goal_diff' => $this->goal_diff,
            'team' => new TeamResource($this->whenLoaded('team')),
        ];
    }
}
