<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EndPointCollection;
use App\Http\Resources\EndPointResource;
use App\Models\Endpoint;

class EndPointController extends Controller
{
    public function index():EndPointCollection
    {
       $endPoint = Endpoint::applySorts(request('sort'))->get();

        return EndPointCollection::make($endPoint);
    }
    public function show(Endpoint $endpoint):EndPointResource
    {
        return EndPointResource::make($endpoint);
    }
}
