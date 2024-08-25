<?php

namespace App\Traits;

use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Support\Collection;

trait FractalTransformer
{
    protected function item($item, $transformer, $includes = null)
    {
        if (!is_null($includes)) {
            return Fractal::item($item, new $transformer($includes))->getArray();
        } else {
            return Fractal::item($item, new $transformer)->getArray();
        }
    }

    protected function collection($collection, $transformer, $key = null, $includes = null)
    {
        if(($collection instanceof Collection && $collection->count() ===0) || (is_array($collection) && count($collection) === 0))
        {
            return [$key ?? 'data' => []];
        }

        if (!is_null($includes)) {
            $collection = Fractal::collection($collection, new $transformer($includes))->getArray();
        } else {
            $collection = Fractal::collection($collection, new $transformer)->getArray();
        }

        if(!is_null($key)) {
            $collection[$key] = $collection['data'];
            unset($collection['data']);
        }
        
        return $collection;
    }
}