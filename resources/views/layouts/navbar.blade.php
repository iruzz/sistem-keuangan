<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Dashboard')</title>

   {{-- Load Tailwind dan Flowbite via Vite --}}
   @vite(['resources/css/app.css', 'resources/js/app.js'])

   {{-- Font Awesome --}}
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

   {{-- Smooth Transition --}}
   <style>
      * { transition: all 0.2s ease-in-out; }
   </style>
</head>

<body class="bg-gray-50 text-gray-900">
   {{-- Navbar --}}
   <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
      <div class="px-4 py-3 lg:px-6">
         <div class="flex items-center justify-between">
            {{-- Left Section --}}
            <div class="flex items-center">
               {{-- Toggle Sidebar (Mobile) --}}
               <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                  aria-controls="logo-sidebar" type="button"
                  class="inline-flex items-center p-2 text-gray-600 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                  </svg>
               </button>

               {{-- Logo --}}
               <a href="{{ route('superadmin.dashboard') }}" class="flex items-center ms-3">
                  <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-2" alt="Logo">
                  <span class="text-xl font-bold text-gray-800">KeuanganApp</span>
               </a>
            </div>

            {{-- Right Section --}}
            <div class="flex items-center gap-4">
               {{-- User Dropdown --}}
               <div class="relative">
                  <button type="button"
                     class="flex items-center gap-2 text-sm rounded-full focus:ring-4 focus:ring-blue-100"
                     aria-expanded="false" data-dropdown-toggle="dropdown-user">
                     <img class="w-9 h-9 rounded-full border border-gray-200"
                        src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                     <span class="hidden sm:block text-gray-800 font-semibold">{{ Auth::user()->name }}</span>
                  </button>

                  {{-- Dropdown Menu --}}
                  <div id="dropdown-user"
                       class="z-50 hidden absolute right-0 mt-2 w-44 bg-white border border-gray-100 rounded-md shadow-md">
                     <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                     </div>
                     <ul class="py-1 text-sm text-gray-700">
                        <li><a href="{{ route('superadmin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50">Dashboard</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-50">Settings</a></li>
                        <li>
                           <form method="POST" action="{{ route('logout') }}">
                              @csrf
                              <button type="submit"
                                 class="w-full text-left px-4 py-2 hover:bg-gray-50">Logout</button>
                           </form>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </nav>

   {{-- Sidebar --}}
   <aside id="logo-sidebar"
      class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0">
      <div class="h-full px-4 pb-4 overflow-y-auto">
         <ul class="space-y-2 font-medium">
           @yield('sidebar')
         </ul>
      </div>
   </aside>

   {{-- Content --}}
   <main class="p-4 sm:ml-64 mt-20">
      <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
         @yield('content')
      </div>
   </main>
</body>
</html>
