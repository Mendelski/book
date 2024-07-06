<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Index;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class IndexFactory extends Factory
{
    protected $model = Index::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title' => $this->faker->word(),
            'page' => $this->faker->randomNumber(),

            'book_id' => Book::factory(),
            'parent_index_id' => Index::factory(),
        ];
    }
}
