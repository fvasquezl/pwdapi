<?php

namespace Tests\Feature\EndPoint;

use App\Models\Endpoint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SortEndPointsTest extends TestCase
{
    use RefreshDatabase;


    #[Test]
    public function it_can_sort_endpoints_by_title(): void
    {
        $endpoint1 = Endpoint::factory()->create(['title'=>'C title']);
        $endpoint2 = Endpoint::factory()->create(['title'=>'B title']);
        $endpoint3 = Endpoint::factory()->create(['title'=>'A title']);

        $url = route('api.v1.endpoints.index', ['sort' => 'title']);
        $this->getJson($url)->assertSeeInOrder(
            [
                $endpoint3->title,
                $endpoint2->title,
                $endpoint1->title
            ]
        );

        $url = route('api.v1.endpoints.index', ['sort' => '-title']);
        $this->getJson($url)->assertSeeInOrder(
            [
                $endpoint1->title,
                $endpoint2->title,
                $endpoint3->title,
            ]
        );
    }


    #[Test]
    public function it_can_sort_endpoints_by_title_and_content(): void
    {
        $endpoint1 = Endpoint::factory()->create([
            'title'=>'C title',
            'content'=> 'B content'
        ]);
        $endpoint2 = Endpoint::factory()->create([
            'title'=>'A title',
            'content'=> 'C content'
        ]);
        $endpoint3 = Endpoint::factory()->create([
            'title'=>'B title',
            'content'=> 'D content'
        ]);

        $url = route('api.v1.endpoints.index', ['sort' => 'title,-content']);

        $this->getJson($url)->assertSeeInOrder(
            [
                $endpoint2->title,
                $endpoint3->title,
                $endpoint1->title,
            ]
        );

        $url = route('api.v1.endpoints.index', ['sort' => '-content,title']);

        $this->getJson($url)->assertSeeInOrder(
            [
                $endpoint3->title,
                $endpoint2->title,
                $endpoint1->title,
            ]
        );
    }
}
