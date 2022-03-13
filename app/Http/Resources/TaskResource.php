<?php


namespace App\Http\Resources;


use App\Http\Resources\v1\Core\CategoryResource;
use App\Http\Resources\v1\Core\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource;


class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'task_id'   => $this->task_id,
            'duration'  => $this->duration,
            'level'     => $this->level,
            'week'      => $this->week,
            'developer' => $this->developer
        ];
    }
}
