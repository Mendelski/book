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

        $firstIndex = Index::create([
            'book_id' => $book->id,
            'title' => 'Alpha',
            'page' => 1,
        ]);

        Index::create([
            'book_id' => $book->id,
            'title' => 'Beta',
            'page' => 2,
            'parent_index_id' => $firstIndex->id,
        ]);
    }
}
