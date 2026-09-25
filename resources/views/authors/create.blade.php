@extends('layouts.app')

@section('title', 'Add Author')

@section('content')
   <div class="max-w-md mx-auto bg-white rounded-xl shadow border border-gray-100 p-6">
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Add Author</h1>

      <form action="{{ route('authors.store') }}" method="POST" class="space-y-4">
         @csrf

         <div>
               <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
               <input type="text" id="name" name="name" value="{{ old('name') }}"
                     class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
               @error('name')
                  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
               @enderror
         </div>

         <div>
            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Birth Date</label>
            <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('birth_date')
               <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
         </div>

         <div class="flex justify-end gap-3 pt-2">
               <a href="{{ route('authors.index') }}"
                  class="px-4 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-100 transition">
                  Cancel
               </a>
               <button type="submit"
                     class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                  Save Author
               </button>
         </div>
      </form>
   </div>
@endsection