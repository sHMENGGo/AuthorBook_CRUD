<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('authors/{author}/remove', [AuthorController::class, 'remove'])->name('authors.remove');
Route::resource('authors', AuthorController::class);

Route::get('books/{book}/remove', [BookController::class, 'remove'])->name('books.remove');
Route::resource('books', BookController::class);
