<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResouce extends JsonResource
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
            'title' => $this->name,
            'start' => $this->end_date->toDateString(),
            'url' => route('mentee.tasks.show', ['id' => $this->id]),
            'interactive' => true
        ];
    }
}
