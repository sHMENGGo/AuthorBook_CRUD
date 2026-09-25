@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
   <div class="max-w-md mx-auto bg-white rounded-xl shadow border border-gray-100 p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Book</h1>

      <form action="{{ route('books.update', $book) }}" method="POST" class="space-y-4">
         @csrf
         @method('PUT')

         <div>
               <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
               <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
               @error('title')
                  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
               @enderror
         </div>

         <div>
               <label for="author_id" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
               <select id="author_id" name="author_id"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                  @foreach ($authors as $author)
                     <option value="{{ $author->id }}"
                           {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                           {{ $author->name }}
                     </option>
                  @endforeach
               </select>
               @error('author_id')
                  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
               @enderror
         </div>

         <div>
               <label for="published_date" class="block text-sm font-medium text-gray-700 mb-1">Published Date</label>
               <input type="date" id="published_date" name="published_date"
                  value="{{ old('published_date', $book->published_date?->format('Y-m-d')) }}"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
               @error('published_date')
                  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
               @enderror
         </div>

         <div class="flex justify-end gap-3 pt-2">
               <a href="{{ route('books.index') }}"
                  class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                  Cancel
               </a>
               <button type="submit"
                     class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                  Update Book
               </button>
         </div>
      </form>
   </div>
@endsection