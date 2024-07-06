<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Index;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::createOrFirst([
            'name' => 'John Doe',
            'email' => 'john_doe@mail.com',
            'password' => bcrypt('password'),
        ]);

        $book = Book::create([
            'user_id' => 1,
            'title' => 'Book Title',
        ]);

        $alpha = Index::create([
            'book_id' => $book->id,
            'title' => 'Alpha',
            'page' => 1,
        ]);

        $beta = Index::create([
            'book_id' => $book->id,
            'title' => 'Beta',
            'page' => 2,
            'parent_index_id' => $alpha->id,
        ]);

        Index::create([
            'book_id' => $book->id,
            'title' => 'Gama',
            'page' => 3,
            'parent_index_id' => $beta->id,
        ]);

        Index::create([
            'book_id' => $book->id,
            'title' => 'Delta',
            'page' => 4,
            'parent_index_id' => null,
        ]);


    }
}
