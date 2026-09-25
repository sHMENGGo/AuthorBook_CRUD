<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Author::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        if ($request->sort === 'asc') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort === 'desc') {
            $query->orderBy('name', 'desc');
        }

        $authors = $query->get();

        if ($request->ajax()) {
            return view('authors.indexTable', compact('authors'));
        }

        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
            'birth_date' => 'required|date_format:Y-m-d|before:today',
        ],

            [
                'birth_date.date_format' => 'Invalid date.',
            ]);

        Author::create($validated);

        return redirect()->route('authors.index')->with('success', 'Author created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        $author->load('books');

        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name,'.$author->id,
            'birth_date' => 'required|date_format:Y-m-d|before:today',
        ],

            [
                'birth_date.date_format' => 'Invalid date.',
            ]);

        $author->update($validated);

        return redirect()->route('authors.index')->with('success', 'Author updated.');
    }

    // Destroy confirmation
    public function remove(Author $author)
    {
        return view('authors.remove', compact('author'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted.');
    }
}
