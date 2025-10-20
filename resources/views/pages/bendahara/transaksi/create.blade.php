
@extends('layouts.navbar')

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
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">

    {{-- ✅ Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ Tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('bendahara.transaksi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700">Kode Transaksi</label>
            <input type="text" name="kode_transaksi" value="{{ old('kode_transaksi') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <input type="text" name="deskripsi" value="{{ old('deskripsi') }}"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

            
        <div>
            <label class="block text-sm font-semibold text-gray-700">Tipe</label>
            <select name="tipe" id=""  class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value=""> Pilih Tipe </option>
                <option value="Pemasukan">Pemasukan</option>
                <option value="Pengeluaran">Pengeluaran</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Total</label>
            <input type="number" name="total"
                class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700">Metode</label>
            <select name="metode" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                 <option value=""> Pilih Metode </option>
                <option value="Tunai">Tunai</option>
                <option value="Transfer">Transfer</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('bendahara.transaksi') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Batal</a>
            <button type="submit"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection

