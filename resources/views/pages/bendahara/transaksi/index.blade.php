@extends('layouts.navbar')

@section('title', 'Daftar Transaksi')
@section('page-title', 'Manajemen Transaksi')

@section('sidebar')
   <li>
      <a href="{{ route('bendahara.dashboard') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Dashboard</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.transaksi') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-receipt w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Transaksi</span>
      </a>
   </li>
@endsection

@section('content')
<div class="relative overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">

   {{-- Header --}}
   <div class="flex items-center justify-between flex-wrap gap-4 px-4 py-3 border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Transaksi</h2>

      <div class="flex items-center gap-3">
         {{-- Search --}}
         <form method="GET" action="{{ route('bendahara.transaksi') }}" class="relative">
            <input type="text" name="q" id="live-search"
               value="{{ request('q') }}"
               class="block w-72 p-2 pl-3 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
               placeholder="Cari transaksi...">
         </form>

         {{-- Tombol Tambah --}}
         <a href="{{ route('bendahara.transaksi.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
            <i class="fas fa-plus"></i> Tambah Transaksi
         </a>
      </div>
   </div>

   {{-- Tabel --}}
   <table class="w-full text-sm text-left text-gray-600">
      <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
         <tr>
            <th class="px-6 py-3 font-semibold">No</th>
            <th class="px-6 py-3 font-semibold">Kode</th>
            <th class="px-6 py-3 font-semibold">Tanggal</th>
            <th class="px-6 py-3 font-semibold">Deskripsi</th>
            <th class="px-6 py-3 font-semibold">Tipe</th>
            <th class="px-6 py-3 font-semibold">Total</th>
            <th class="px-6 py-3 font-semibold">User</th>
            <th class="px-6 py-3 font-semibold">Metode</th>
         </tr>
      </thead>
      <tbody id="transaksi-table">
         @foreach ($transaksi as $i => $item)
         <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition">
            <td class="px-6 py-4">{{ $i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->kode_transaksi }}</td>
            <td class="px-6 py-4">{{ $item->tanggal }}</td>
            <td class="px-6 py-4">{{ $item->deskripsi }}</td>
            <td class="px-6 py-4">
               <span class="px-2 py-1 text-xs font-semibold rounded-full 
                  {{ $item->tipe == 'Pemasukan' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                  {{ $item->tipe }}
               </span>
            </td>
            <td class="px-6 py-4 font-semibold text-gray-800">
               Rp {{ number_format($item->total, 0, ',', '.') }}
            </td>
            <td class="px-6 py-4">{{ $item->user->name }}</td>
            <td class="px-6 py-4">{{ $item->metode }}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>

{{-- Realtime search --}}

@endsection
