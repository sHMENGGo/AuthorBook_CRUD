@extends('layouts.app')

@section('title', 'Home')

@section('content')
   <div class="text-center py-20">
      <h1 class="text-4xl font-bold text-gray-800 mb-4">Author & Book CRUD</h1>
      <p class="text-gray-500 mb-8">Manage your authors and their books in one place.</p>

      <div class="flex items-center justify-center gap-4">
         <a href="{{ route('authors.index') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium shadow-sm hover:bg-blue-700 transition">
               View Authors
         </a>
         <a href="{{ route('books.index') }}"
            class="bg-gray-800 text-white px-6 py-3 rounded-lg font-medium shadow-sm hover:bg-gray-900 transition">
               View Books
         </a>
      </div>
   </div>
@endsection