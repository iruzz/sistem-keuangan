<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="flex min-h-screen bg-gray-50">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 shadow-lg flex flex-col">
        <!-- Logo -->
        <div class="p-4 border-b border-gray-700 flex items-center justify-between">
            <h1 class="text-lg font-bold text-white">Sistem Keuangan</h1>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            @role('super-admin')
                <a href="{{ route('superadmin.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('superadmin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard Super Admin
                </a>
            @endrole
            @role('accounting')
                <a href="{{ route('accounting.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('accounting.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard Accounting
                </a>
            @endrole
            @role('finance')
                <a href="{{ route('finance.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('finance.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard Finance
                </a>
            @endrole
            @role('hrd')
                <a href="{{ route('hrd.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('hrd.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard HRD
                </a>
            @endrole
            @role('employee')
                <a href="{{ route('employee.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('employee.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard Employee
                </a>
            @endrole
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar -->
        @auth
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900">@yield('title', 'Dashboard')</h1>

                <!-- User dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 px-4 py-2 bg-white rounded-lg shadow-sm hover:shadow-md transition">
                        <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center text-white font-medium text-xs">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        <div class="text-left">
                            <div class="text-base text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-2 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        @endauth

        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>
