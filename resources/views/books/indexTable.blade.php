<div class="bg-white rounded-xl shadow overflow-auto max-h-7/10 scrollbar-thin scrollbar-thumb-gray-300 border border-gray-300">
   <table class="w-full text-left">
      <thead class="bg-gray-50 border-b border-gray-200">
         <tr>
            <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide">Title</th>
            <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide">Author</th>
            <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide">Published</th>
            <th class="px-6 py-3 text-sm font-semibold text-gray-600 uppercase tracking-wide text-right">Actions</th>
         </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
         @forelse ($books as $book)
            <tr class="hover:bg-gray-100 cursor-pointer transition" onClick="window.location='{{ route('books.show', $book) }}'">
               <td class="px-6 py-4 text-gray-800 font-medium">{{ $book->title }}</td>
               <td class="px-6 py-4 text-gray-600">{{ $book->author->name }}</td>
               <td class="px-6 py-4 text-gray-600">{{ $book->published_date?->format('F j, Y') }}</td>
               <td class="px-6 py-4 text-right space-x-3">
                  <a href="{{ route('books.edit', $book) }}" onclick="event.stopPropagation()" class="inline-block text-blue-600 hover:text-blue-800 hover:underline">Edit</a>
                  <a href="{{ route('books.remove', $book) }}" onclick="event.stopPropagation()" class="text-red-600 hover:text-red-800 hover:underline">Delete</a>
               </td>
            </tr>
         @empty
            <tr>
               <td colspan="4" class="px-6 py-10 text-center text-gray-400">No books match your search.</td>
            </tr>
         @endforelse
      </tbody>
   </table>
</div>