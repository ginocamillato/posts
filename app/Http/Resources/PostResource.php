<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title' => $this->title,
            'body' => $this->body,
            'userId' => $this->user_id,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}

