<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <title>@yield('title', 'Author & Book CRUD')</title>
   @vite(['resources/css/app.css'])
</head>
<body class="bg-black/10 overflow-hidden flex flex-col h-screen">
   <header class="w-full h-fit bg-white border-b border-gray-200 shadow-sm z-50">
      <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
         <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600 transition">
               Author & Book CRUD
         </a>

         <nav class="flex items-center gap-3">
            <a href="{{ route('authors.index') }}"
               class="px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
               Authors
            </a>
            <a href="{{ route('books.index') }}"
               class="px-4 py-2 rounded-lg text-gray-600 hover:bg-gray-100 hover:text-gray-900 transition">
               Books
            </a>
         </nav>
      </div>
   </header>

   <main class="p-10 h-full">
      @yield('content')
   </main>
</body>
</html>