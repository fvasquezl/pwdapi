<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'type' => 'endpoints',
                'id' => (string) $this->resource->getRouteKey(),
                'attributes' => [
                    'title' =>  $this->resource->title,
                    'slug' =>  $this->resource->slug,
                    'content' =>  $this->resource->content,
                ],
                'links' => [
                    'self' => route('api.v1.endpoints.show', $this->resource),
                ]
        ];
    }
}
