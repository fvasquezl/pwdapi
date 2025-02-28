<?php

namespace Tests\Feature\EndPoint;

use App\Models\Endpoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListEndpointTest extends TestCase
{
    use RefreshDatabase;


    #[Test]
    public function can_fetch_single_endpoint(): void
    {
        $endpoint= Endpoint::factory()->create();
        $response = $this->getJson(route('api.v1.endpoints.show',$endpoint));
        $response->assertExactJson([
            'data' => [
                'type' => 'endpoints',
                'id' => (string) $endpoint->getRouteKey(),
                'attributes' => [
                    'title' => $endpoint->title,
                    'slug' => $endpoint->slug,
                    'content' => $endpoint->content,
                ],
                'links' => [
                    'self' => route('api.v1.endpoints.show',$endpoint)
                ]
            ]
        ]);
    }


    #[Test]
    public function can_fetch_all_endpoints(): void
    {
        $endpoint= Endpoint::factory()->count(3)->create();
        $response = $this->getJson(route('api.v1.endpoints.index'));
        $response->assertExactJson([
            'data'=>[
                [
                    'type' => 'endpoints',
                    'id' => (string) $endpoint[0]->getRouteKey(),
                    'attributes' => [
                        'title' => $endpoint[0]->title,
                        'slug' => $endpoint[0]->slug,
                        'content' => $endpoint[0]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.endpoints.show',$endpoint[0])
                    ]
                ],
                [
                    'type' => 'endpoints',
                    'id' => (string) $endpoint[1]->getRouteKey(),
                    'attributes' => [
                        'title' => $endpoint[1]->title,
                        'slug' => $endpoint[1]->slug,
                        'content' => $endpoint[1]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.endpoints.show',$endpoint[1])
                    ]
                ],
                [
                    'type' => 'endpoints',
                    'id' => (string) $endpoint[2]->getRouteKey(),
                    'attributes' => [
                        'title' => $endpoint[2]->title,
                        'slug' => $endpoint[2]->slug,
                        'content' => $endpoint[2]->content,
                    ],
                    'links' => [
                        'self' => route('api.v1.endpoints.show',$endpoint[2])
                    ]
                ],
            ],
            'links'=>[
                'self' => route('api.v1.endpoints.index')
            ]
        ]);
    }
}
