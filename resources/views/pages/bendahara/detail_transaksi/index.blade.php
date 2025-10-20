@extends('layouts.navbar')

@section('title', 'Daftar Detail Transaksi')
@section('page-title', 'Manajemen Detail Transaksi')

@section('sidebar')
   <li>
      <a href="{{ route('bendahara.dashboard') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Dashboard</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.akun') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-wallet w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Akun Keuangan</span>
      </a>
   </li>

    <li>
      <a href="{{ route('bendahara.kasBank') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-piggy-bank w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Kas/Bank</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.transaksi') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-receipt w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Transaksi</span>
      </a>
   </li>

   <li>
      <a href="{{ route('bendahara.detailTs') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 group">
         <i class="fa-solid fa-list w-5 text-gray-500 group-hover:text-blue-600"></i>
         <span class="ms-3 font-medium">Detail Transaksi</span>
      </a>
   </li>


@endsection


@section('content')
<div class="relative overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">

   {{-- Header --}}
   <div class="flex items-center justify-between flex-wrap gap-4 px-4 py-3 border-b border-gray-100">
      <h2 class="text-lg font-semibold text-gray-800">Daftar Detail Transaksi</h2>

      <div class="flex items-center gap-3">
         {{-- Search --}}
         <form method="GET" action="{{ route('bendahara.detailTs') }}" class="relative">
            <input type="text" name="q" id="live-search"
               value="{{ request('q') }}"
               class="block w-72 p-2 pl-3 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
               placeholder="Cari detail transaksi...">
         </form>

         {{-- Tombol Tambah --}}
         <a href="{{ route('bendahara.detailTs.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition">
            <i class="fas fa-plus"></i> Tambah Detail
         </a>
      </div>
   </div>

   {{-- Tabel --}}
   <table class="w-full text-sm text-left text-gray-600">
      <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
         <tr>
            <th class="px-6 py-3 font-semibold">No</th>
            <th class="px-6 py-3 font-semibold">Transaksi</th>
            <th class="px-6 py-3 font-semibold">Akun</th>
            <th class="px-6 py-3 font-semibold">Debit</th>
            <th class="px-6 py-3 font-semibold">Kredit</th>
            <th class="px-6 py-3 font-semibold">Keterangan</th>
            <th class="px-6 py-3 font-semibold text-center">Aksi</th>
         </tr>
      </thead>
      <tbody id="detail-table">
         @foreach ($detail as $i => $item)
         <tr class="bg-white border-b border-gray-100 hover:bg-gray-50 transition">
            <td class="px-6 py-4">{{ $i + 1 }}</td>
            <td class="px-6 py-4 font-medium text-gray-800">{{ $item->transaksi->kode_transaksi }}</td>
            <td class="px-6 py-4">
               <p class="font-semibold text-gray-800">{{ $item->akun->nama_akun }}</p>
               <p class="text-xs text-gray-500">{{ $item->akun->kode_akun }}</p>
            </td>
            <td class="px-6 py-4 font-semibold text-gray-800">
               @if($item->debit > 0)
                  Rp {{ number_format($item->debit, 0, ',', '.') }}
               @else
                  -
               @endif
            </td>
            <td class="px-6 py-4 font-semibold text-gray-800">
               @if($item->kredit > 0)
                  Rp {{ number_format($item->kredit, 0, ',', '.') }}
               @else
                  -
               @endif
            </td>
            <td class="px-6 py-4">{{ $item->keterangan ?? '-' }}</td>

            {{-- Aksi --}}
            <td class="px-6 py-4 text-center">
               <div class="flex items-center justify-center gap-2">
                  {{-- Edit --}}
                  <a href="{{ route('bendahara.detailTs.edit', $item->id) }}"
                     class="inline-flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 hover:bg-blue-200 rounded-full transition"
                     title="Edit">
                     <i class="fas fa-edit"></i>
                  </a>

                  {{-- Hapus --}}
                  <form action="{{ route('bendahara.detailTs.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus detail transaksi ini?');">
                     @csrf
                     @method('DELETE')
                     <button type="submit"
                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-100 hover:bg-red-200 rounded-full transition"
                        title="Hapus">
                        <i class="fas fa-trash"></i>
                     </button>
                  </form>
               </div>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection
