<?php

use App\Models\Book;
use App\Models\Author;

test('can view books list', function () {
   $response = $this->get(route('books.index'));
   $response->assertOk();
});

test('can view create book page', function () {
   $response = $this->get(route('books.create'));
   $response->assertOk();
});

test('can store a book', function () {
   $author = Author::factory()->create([]);

   $response = $this->post(route('books.store'), [
      'title' => 'Test Book',
      'published_date' => '1990-01-01',
      'author_id' => $author->id
   ]);

   $response->assertRedirect(route('books.index'));
   $this->assertDatabaseHas('books', ['title' => 'Test Book']);
});

test('can view edit book page', function () {
   $author = Author::factory()->create([]);
   $book = Book::factory()->create(['author_id' => $author->id]);

   $response = $this->get(route('books.edit', $book));
   $response->assertOk();
});

test('can update a book', function () {
   $author = Author::factory()->create(['birth_date' => '1950-01-01']);
   $book = Book::factory()->create(['author_id' => $author->id]);

   $response = $this->put(route('books.update', $book), [
      'title' => 'Updated Book',
      'published_date' => '1990-01-01',
      'author_id' => $author->id,
   ]);

   $response->assertRedirect(route('books.index'));
   $this->assertDatabaseHas('books', ['title' => 'Updated Book']);
});

test('can view remove book page', function () {
   $author = Author::factory()->create([]);
   $book = Book::factory()->create(['author_id' => $author->id]);

   $response = $this->get(route('books.remove', $book));
   $response->assertOk();
});

test('can destroy a book', function () {
   $author = Author::factory()->create([]);
   $book = Book::factory()->create(['author_id' => $author->id]);

   $response = $this->delete(route('books.destroy', $book));

   $response->assertRedirect(route('books.index'));
   $this->assertDatabaseMissing('books', ['id' => $book->id]);
});
