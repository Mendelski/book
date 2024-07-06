<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Index extends Model
{
    use SoftDeletes, HasUuids, HasUuids, HasUuids, HasFactory;

    protected $fillable = [
        'book_id',
        'parent_index_id',
        'title',
        'page',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function parentIndex(): BelongsTo
    {
        return $this->belongsTo(Index::class, 'parent_index_id');
    }
}
