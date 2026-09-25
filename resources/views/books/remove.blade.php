@extends('layouts.app')

@section('title', 'Delete Book')

@section('content')
   <div class="max-w-md mx-auto items-center flex flex-col gap-10 bg-white rounded-xl shadow border border-gray-100 p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-2">Delete Book</h1>
      <p class="text-gray-600 mb-6 text-center">
         Are you sure you want to delete <span class="font-semibold text-gray-800">{{ $book->title }}</span>
         by {{ $book->author->name }}? This action cannot be undone.
      </p>

      <div class="flex justify-end gap-3">
         <a href="{{ route('books.index') }}"
            class="px-4 py-2 rounded-lg cursor-pointer text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
               Cancel
         </a>

         <form action="{{ route('books.destroy', $book) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
               class="bg-red-600 text-white border px-4 py-2 rounded-lg text-sm font-medium cursor-pointer hover:bg-red-700 transition">
               Delete Book
            </button>
         </form>
      </div>
   </div>
@endsection