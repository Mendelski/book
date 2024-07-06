<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public static function getBooks(?string $bookTitle, ?string $indexTitle)
    {
        $builder = Book::query()->with('index');

        if ($bookTitle) {
            $builder = $builder->where('title', 'like', "%$bookTitle%");
        }
        if ($indexTitle) {
            $builder = $builder->whereHas('index', function ($query) use ($indexTitle) {
                $query->where('title', 'like', "%$indexTitle%");
            });
        }

        return $builder->get();
    }
}
