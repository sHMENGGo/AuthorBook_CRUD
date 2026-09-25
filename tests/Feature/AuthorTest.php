<?php

use App\Models\Author;

test('can view authors list', function () {
    $response = $this->get(route('authors.index'));
    $response->assertOk();
});

test('can view create author page', function () {
    $response = $this->get(route('authors.create'));
    $response->assertOk();
});

test('can store an author', function () {
    $response = $this->post(route('authors.store'), [
        'name' => 'Test Author',
        'birth_date' => '1990-01-01',
    ]);

    $response->assertRedirect(route('authors.index'));
    $this->assertDatabaseHas('authors', ['name' => 'Test Author']);
});

test('can view edit author page', function () {
    $author = Author::factory()->create();

    $response = $this->get(route('authors.edit', $author));
    $response->assertOk();
});

test('can update an author', function () {
    $author = Author::factory()->create();

    $response = $this->put(route('authors.update', $author), [
        'name' => 'Updated Author',
        'birth_date' => '1990-01-01',
    ]);

    $response->assertRedirect(route('authors.index'));
    $this->assertDatabaseHas('authors', ['name' => 'Updated Author']);
});

test('can view remove author page', function () {
    $author = Author::factory()->create();

    $response = $this->get(route('authors.remove', $author));
    $response->assertOk();
});

test('can destroy an author', function () {
    $author = Author::factory()->create();

    $response = $this->delete(route('authors.destroy', $author));

    $response->assertRedirect(route('authors.index'));
    $this->assertDatabaseMissing('authors', ['id' => $author->id]);
});
