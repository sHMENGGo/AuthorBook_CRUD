<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\models\Book;
use App\models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'author_id' => fn ()=> $authorIds->random()
        ]);
    }
}
