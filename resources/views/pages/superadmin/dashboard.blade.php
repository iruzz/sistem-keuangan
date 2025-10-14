@extends('layouts.navbar')

@section('title', 'Dashboard Super Admin')
@section('page-title', 'Dashboard')

@section('sidebar')
         <li>
               <a href="{{ route('superadmin.dashboard')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Dashboard</span>
               </a>
            </li>
               <a href="{{ route('superadmin.users')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Users</span>
               </a>
            </li>

              </li>
               <a href="{{ route('superadmin.akun')}}"
                  class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
                  <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-600"></i>
                  <span class="ms-3 font-medium">Akun Keuangan</span>
               </a>
            </li>

@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    {{-- CARD: Welcome --}}
    <div class="col-span-1 md:col-span-2 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-xl shadow-lg p-6 flex items-center gap-5 text-white">
        <div class="w-20 h-20 flex items-center justify-center bg-white/20 backdrop-blur-md text-3xl font-bold rounded-full shadow-inner">
            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
        </div>
        <div>
            <h2 class="text-2xl font-semibold">Selamat datang, {{ Auth::user()->name }} 👋</h2>
            <p class="text-gray-100 mt-1">Email: {{ Auth::user()->email }}</p>
            <p class="text-blue-100 italic">Role: {{ Auth::user()->getRoleNames()->join(', ') }}</p>
        </div>
    </div>

    {{-- CARD: Total Pengguna --}}
    <div class="bg-white dark:bg-gray-100 rounded-xl p-6 flex items-center gap-5 shadow-md hover:shadow-xl transition-all duration-300 border border-transparent hover:border-indigo-400">
        <div class="w-14 h-14 flex items-center justify-center bg-indigo-500 text-white rounded-full">
            <i class="fas fa-users text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 dark:text-gray-700 text-sm">Total Pengguna</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-700">
                {{ \App\Models\User::count() }}
            </h3>
        </div>
    </div>

    {{-- CARD: Total Role --}}
    <div class="bg-white dark:bg-gray-100 rounded-xl p-6 flex items-center gap-5 shadow-md hover:shadow-xl transition-all duration-300 border border-transparent hover:border-green-400">
        <div class="w-14 h-14 flex items-center justify-center bg-green-500 text-white rounded-full">
            <i class="fas fa-user-tag text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 dark:text-gray-700 text-sm">Total Role</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-700 italic">
                {{ \Spatie\Permission\Models\Role::count() }}
            </h3>
        </div>
    </div>

    {{-- CARD: Total Permissions --}}
    <div class="bg-white dark:bg-gray-100 rounded-xl p-6 flex items-center gap-5 shadow-md hover:shadow-xl transition-all duration-300 border border-transparent hover:border-yellow-400">
        <div class="w-14 h-14 flex items-center justify-center bg-yellow-500 text-white rounded-full">
            <i class="fas fa-shield-halved text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 dark:text-gray-700 text-sm">Total Permissions</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-700 ">
                {{ \Spatie\Permission\Models\Permission::count() }}
            </h3>
        </div>
    </div>

    {{-- CARD: Total Akun (Accounts) --}}
    <div class="bg-white dark:bg-gray-100 rounded-xl p-6 flex items-center gap-5 shadow-md hover:shadow-xl transition-all duration-300 border border-transparent hover:border-blue-400">
        <div class="w-14 h-14 flex items-center justify-center bg-blue-500 text-white rounded-full">
            <i class="fas fa-coins text-xl"></i>
        </div>
        <div>
            <p class="text-gray-500 dark:text-gray-700 text-sm">Total Akun Keuangan</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-700">
                
            </h3>
        </div>
    </div>

</div>
@endsection
