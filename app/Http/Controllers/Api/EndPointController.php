<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EndPointCollection;
use App\Http\Resources\EndPointResource;
use App\Models\Endpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EndPointController extends Controller
{
    public function index()
    {
        $sortFields =Str::of(request()->query('sort'))->explode(',');
        $endPointQuery = Endpoint::query();
        foreach ($sortFields as $sortField) {
            $direction = 'asc';
            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->replace('-','');
            }
            $endPointQuery->orderBy($sortField,$direction);
        }

        return EndPointCollection::make($endPointQuery->get());
    }
    public function show(Endpoint $endpoint)
    {
        return EndPointResource::make($endpoint);
    }
}
