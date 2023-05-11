<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PresenceResource extends JsonResource
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
            'url' => route('mentee.presence.index'),
            'name' => $this->name,
            'class' => $this->class->name,
            'closed_at' => $this->closed_clock,
        ];
    }
}
