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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'id' => $this->id,
            'title' => $this->title,
            'page' => $this->page,

            'book_id' => $this->book_id,
            'parent_index_id' => $this->parent_index_id,

            'book' => new BookResource($this->whenLoaded('book')),
            'parentIndex' => new BookResource($this->whenLoaded('parentIndex')),
        ];
    }
}
