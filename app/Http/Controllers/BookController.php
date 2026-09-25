<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('author');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->sort === 'asc') {
            $query->orderBy('title', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('title', 'desc');
        }

        $books = $query->get();

        if($request->ajax()) {
            return view('books.indexTable', compact('books'));
        }

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author_id' => 'required|exists:authors,id',
            'published_date' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $author = Author::find($request->author_id);
                    if ($author && $author->birth_date && $value < $author->birth_date->format('Y-m-d')) {
                        $fail('The published date cannot be before the author\'s birth date.');
                    }
                },
            ],
        ],

        [
            'published_date.date_format' => 'Invalid date.',
        ]);

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load('author');
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::orderBy('name')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'published_date' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today',
                function ($attribute, $value, $fail) use ($request) {
                    $author = Author::find($request->author_id);
                    if ($author && $author->birth_date && $value < $author->birth_date->format('Y-m-d')) {
                        $fail('The published date cannot be before the author\'s birth date.');
                    }
                },
            ],
        ],
        [
            'published_date.date_format' => 'Invalid date.',
        ]);

        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Book updated.');
    }

    // Destroy confirmation
    public function remove(Book $book)
    {
        return view('books.remove', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted.');
    }
}
