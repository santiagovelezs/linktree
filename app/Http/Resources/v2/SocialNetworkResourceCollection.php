<?php

namespace App\Http\Resources\v2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SocialNetworkResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'links' => [
                'self' => route('apiv2.social-networks.index')
            ],
            'meta' => [
                'count' => $this->collection->count()
            ],
            'data' => $this->collection            
        ];
    }
}
