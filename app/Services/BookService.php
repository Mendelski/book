<?php

namespace App\Services;

use App\Models\Index;

class BookService
{
    public static function getBooks(?string $bookTitle, ?string $indexTitle)
    {
        $builder = Index::query();

        if ($bookTitle) {
            $builder->whereHas('book', function ($query) use ($bookTitle) {
                $query->where('title', 'like', "%$bookTitle%");
            });
        }

        if ($indexTitle) {
            $builder->where('title', 'like', "%$indexTitle%");
        }


        return $builder->get();
    }
}
