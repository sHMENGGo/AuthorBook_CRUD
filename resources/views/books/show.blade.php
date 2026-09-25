@extends('layouts.app')

@section('title', $book->title)

@section('content')
   <div class="max-w-2xl mx-auto">
      <div class="bg-white rounded-xl shadow border border-gray-100 p-6 mb-6">
         <div class="flex items-start justify-between mb-4">
            <div>
               <h1 class="text-3xl font-bold text-gray-800">{{ $book->title }}</h1>
               <p class="text-gray-500 mt-1">
                  Published {{ $book->published_date?->format('F j, Y') ?? 'Unknown' }}
               </p>
            </div>

            <div class="flex gap-3">
               <a href="{{ route('books.edit', $book) }}"
                  class="px-4 py-2 rounded-lg text-blue-600 hover:bg-blue-50 transition">
                  Edit
               </a>
               <a href="{{ route('books.remove', $book) }}"
                  class="px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition">
                  Delete
               </a>
            </div>
         </div>

         <a href="{{ route('books.index') }}" class="hover:underline text-sm text-gray-500 hover:text-gray-700">
               &larr; Back to Books
         </a>
      </div>

      <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
         <h2 class="text-xl font-bold text-gray-800 mb-4">Author</h2>

         <div class="flex items-center justify-between">
            <div>
               <a href="{{ route('authors.show', $book->author) }}"
                  class="font-medium text-gray-800 hover:text-blue-600 transition">
                  {{ $book->author->name }}
               </a>
               <p class="text-sm text-gray-500">
                  Born {{ $book->author->birth_date?->format('F j, Y') ?? 'Unknown' }}
               </p>
            </div>
            <a href="{{ route('authors.show', $book->author) }}"
               class="hover:underline text-blue-600 hover:text-blue-800">
               View Author
            </a>
         </div>
      </div>
   </div>
@endsection