<?php

namespace App\Http\Resources;

use App\Http\Resources\Product as ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * @param $resource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collect($resource)
    {
        return $collects = ProductResource::collection($resource);
    }
}
