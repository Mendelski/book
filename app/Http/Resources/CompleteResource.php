<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompleteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $indexId = $this->resource->id;

        return [
            'titulo' => $this->book->title,
            'usuario_publicador' => [
                'id' => $this->book->user->id,
                'name' => $this->book->user->name,
            ],
            'indices' => IndexResource::collection($this->book->index->where('parent_index_id', $indexId)),
        ];
    }
}
