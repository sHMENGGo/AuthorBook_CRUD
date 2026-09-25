@extends('layouts.app')

@section('title', $author->name)

@section('content')
   <div class="max-w-2xl mx-auto h-full">
      <div class="bg-white rounded-xl shadow border border-gray-100 p-6 mb-6">
         <div class="flex items-start justify-between mb-4">
            <div>
               <h1 class="text-3xl font-bold text-gray-800">{{ $author->name }}</h1>
               <p class="text-gray-500 mt-1">
                  Born {{ $author->birth_date?->format('F j, Y') ?? 'Unknown' }}
               </p>
            </div>

            <div class="flex gap-3">
               <a href="{{ route('authors.edit', $author) }}"
                  class="px-4 py-2 rounded-lg text-blue-600 hover:bg-blue-50 transition">
                  Edit
               </a>
               <a href="{{ route('authors.remove', $author) }}"
                  class="px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition">
                  Delete
               </a>
            </div>
         </div>

         <a href="{{ route('authors.index') }}" class="text-sm hover:underline text-gray-500 hover:text-gray-700">
            &larr; Back to Authors
         </a>
      </div>

      <div class="bg-white rounded-xl shadow border border-gray-100 p-6 max-h-3/5 flex flex-col overflow-hidden">
         <h2 class="text-xl font-bold text-gray-800 mb-4">
            Books ({{ $author->books->count() }})
         </h2>

         <div class="h-full overflow-auto p-4 scrollbar-thin scrollbar-thumb-gray-300 shadow-[inset_0_0_5px_rgba(0,0,0,0.2)] rounded" >
            @forelse ($author->books as $book)
               <div class="flex items-center justify-between py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                  <div>
                     <p class="font-medium text-gray-800">{{ $book->title }}</p>
                     <p class="text-sm text-gray-500">
                           Published {{ $book->published_date?->format('F j, Y') ?? 'Unknown' }}
                     </p>
                  </div>
                  <a href="{{ route('books.edit', $book) }}" class="hover:underline text-blue-600 hover:text-blue-800">
                     Edit
                  </a>
               </div>
            @empty
               <p class="text-gray-400 text-center py-6">This author has no books yet.</p>
            @endforelse
         </div>
      </div>
   </div>
@endsection