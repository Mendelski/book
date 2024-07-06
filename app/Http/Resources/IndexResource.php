<?php

namespace App\Http\Resources;

use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Index */
class IndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'pagina' => $this->page,
            'subindices' => new IndexResource($this->parentIndex),
        ];
    }
}
