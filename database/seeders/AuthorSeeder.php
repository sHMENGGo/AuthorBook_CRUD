<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Author::create(['name' => 'George Orwell', 'birth_date' => '1903-06-25']);
        Author::create(['name' => 'Jane Austen', 'birth_date' => '1775-12-16']);
        Author::create(['name' => 'Mark Twain', 'birth_date' => '1835-11-30']);
    }
}
