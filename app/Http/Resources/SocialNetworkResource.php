<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SocialNetworkResource extends JsonResource
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
            
            'type' => 'socialNetworks',
            'id' => $this->id,
            'attributes' => [
                'type' => $this->type,
                'url' => $this->url,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at             
            ],
            'links' => [
                'self' => route('apiv2.social-networks.show', $this->id)
            ]            
        ];
    }
}
