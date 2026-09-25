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

   <form id="search-form" method="GET" action="{{ route('authors.index') }}" class="flex items-start gap-3 mb-4">
      <input type="text" name="search" id="search-input" value="{{ request('search') }}" placeholder="Search by name..."
         class="w-1/3 border border-gray-300 bg-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

      <input type="hidden" name="sort" id="sort-input" value="{{ request('sort') }}">

      <button type="submit"
         class="px-4 py-2 rounded-lg text-sm font-medium text-white hover:bg-gray-700 bg-gray-600 cursor-pointer transition">
         Search
      </button>

      @php
         $nextSort = request('sort') === 'asc' ? 'desc' : 'asc';
      @endphp

      <button type="submit" id="sort-button" name="sort" value="{{ $nextSort }}"
         data-next-sort="{{ $nextSort }}"
         class="inline-flex items-center gap-1 px-4 py-2 rounded-lg text-sm font-medium text-white hover:bg-gray-700 bg-gray-600 cursor-pointer transition">
         Name
         <span id="sort-icon">
            @if (request('sort') === 'asc')
               &uarr;
            @elseif (request('sort') === 'desc')
               &darr;
            @else
               &#8597;
            @endif
         </span>
      </button>
   </form>

   <div id="authors-table" class="h-full" >
      @include('authors.indexTable', ['authors' => $authors])
   </div>

   <script>
      const form = document.getElementById('search-form');
      const searchInput = document.getElementById('search-input');
      const sortInput = document.getElementById('sort-input');
      const sortButton = document.getElementById('sort-button');
      const sortIcon = document.getElementById('sort-icon');
      const tableContainer = document.getElementById('authors-table');
      const baseUrl = '{{ route('authors.index') }}';

      async function loadAuthors(params) {
         const response = await fetch(`${baseUrl}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
         });
         const html = await response.text();
         tableContainer.innerHTML = html;
         history.pushState({}, '', `${baseUrl}?${params.toString()}`);
      }

      // "Search" button / pressing Enter
      form.addEventListener('submit', function (e) {
         e.preventDefault();
         const params = new URLSearchParams(new FormData(form));
         loadAuthors(params);
      });

      // "Sort" button — toggles direction, then submits
      sortButton.addEventListener('click', function (e) {
         e.preventDefault();

         const nextSort = sortButton.dataset.nextSort;
         sortInput.value = nextSort;

         const params = new URLSearchParams(new FormData(form));
         params.set('sort', nextSort);

         loadAuthors(params).then(() => {
            // flip the icon and prep the next toggle
            sortIcon.innerHTML = nextSort === 'asc' ? '&uarr;' : '&darr;';
            const newNext = nextSort === 'asc' ? 'desc' : 'asc';
            sortButton.dataset.nextSort = newNext;
            sortButton.value = newNext;
         });
      });
   </script>
@endsection