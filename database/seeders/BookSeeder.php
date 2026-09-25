<?php

namespace Database\Seeders;

use App\models\Author;
use App\models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authorIds = Author::pluck('id');

        Book::factory(50)->create([
            'author_id' => fn () => $authorIds->random(),
        ]);
    }
}
