<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => [
                'users' => $this->collection,
            ]
        ];
    }
}