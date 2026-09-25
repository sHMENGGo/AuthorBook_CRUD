@extends('layouts.app')

@section('title', 'Authors')

@section('content')
   <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-800">Authors</h1>
      <a href="{{ route('authors.create') }}"
         class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-medium shadow-sm hover:bg-blue-700 transition">
         + Add Author
      </a>
   </div>

   @if (session('success'))
      <div id="success-toast"
            class="absolute top-20 place-self-center z-50 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-lg transition-opacity duration-500">
         {{ session('success') }}
      </div>
      <script>
         setTimeout(() => {
               const toast = document.getElementById('success-toast');
               if (toast) {
                  toast.style.opacity = '0';
                  setTimeout(() => toast.remove(), 500);
               }
         }, 2000);
      </script>
   @endif

   <div class="bg-white rounded-xl shadow overflow-auto max-h-8/10 border border-gray-100">
      <table class="w-full text-left">
         <thead class="bg-gray-50 border-b border-gray-200">
               <tr>
                  <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide">Name</th>
                  <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide">Birth Date</th>
                  <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide text-right">Actions</th>
               </tr>
         </thead>
         <tbody class="divide-y divide-gray-200">
            @forelse ($authors as $author)
               <tr class="hover:bg-gray-100 cursor-pointer transition" onClick="window.location='{{ route('authors.show', $author) }}'" >
                  <td class="px-6 py-4 text-gray-800 font-medium">{{ $author->name }}</td>
                  <td class="px-6 py-4 text-gray-600">{{ $author->birth_date->format('F j, Y') }}</td>
                  <td class="px-6 py-4 text-right space-x-3">
                     <a href="{{ route('authors.edit', $author) }}"
                        onclick="event.stopPropagation()"
                        class="inline-block text-blue-600 hover:text-blue-800 hover:underline">
                        Edit
                     </a>
                     <a href="{{ route('authors.remove', $author) }}" 
                        onclick="event.stopPropagation()"
                        class=" text-red-600 hover:text-red-800 hover:underline">
                        Delete
                     </a>
                  </td>
               </tr>
            @empty
               <tr>
                  <td colspan="2" class="px-6 py-10 text-center text-gray-400">
                     No authors yet — add your first one above.
                  </td>
               </tr>
            @endforelse
         </tbody>
      </table>
   </div>
@endsection