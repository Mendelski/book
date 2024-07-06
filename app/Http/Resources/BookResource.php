<?php

namespace App\Http\Resources;

use App\Models\Book;
use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Book */
class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $index = $this->load('index')->id;
        $parent = Index::where('parent_index_id', $index);

        return [
            'titulo' => $this->title,
            'usuario_publicador' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'indices' => IndexResource::collection($this->index),
        ];
    }
}
