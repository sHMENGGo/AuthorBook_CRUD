<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class AuthorFactory extends Factory
{
   /**
    * Define the model's default state.
    *
    * @return array<string, mixed>
    */
   public function definition(): array
   {
      return [
         'name' => fake()->name(),
         'birth_date' => fake()->dateTimeBetween('-226 years', '-26 years')->format('Y-m-d')
      ];
   }
}
