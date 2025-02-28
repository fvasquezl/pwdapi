<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

trait HasSorts
{
    public function ScopeApplySorts(Builder $query, $sort): void
    {
        if(!property_exists($this, 'allowedSorts')) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'AllowedSorts property must be defined'.get_class($this)); //500
        }
        if (is_null($sort)) {
            return;
        }

        $sortFields =Str::of($sort)->explode(',');
        foreach ($sortFields as $sortField) {
            $direction = 'asc';
            if(Str::of($sortField)->startsWith('-')){
                $direction = 'desc';
                $sortField = Str::of($sortField)->replace('-','');
            }
            if(! collect($this->allowedSorts)->contains($sortField)){
                abort(Response::HTTP_BAD_REQUEST, "Invalid Query Parameter,{ $sortField} is not allowed.");//400
            }

            $query->orderBy($sortField,$direction);
        }
    }
}