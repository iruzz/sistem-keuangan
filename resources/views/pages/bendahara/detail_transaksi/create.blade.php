@extends('layouts.navbar')

@section('title', 'Tambah Detail Transaksi')
@section('page-title', 'Tambah Detail Transaksi')

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

<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Detail Transaksi</h2>

    {{-- ✅ Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bendahara.detailTs.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Transaksi</label>
            <select name="transaksi_id" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                <option value=""> Pilih Transaksi </option>
                @foreach($transaksi as $t)
                    <option value="{{ $t->id }}" {{ old('transaksi_id') == $t->id ? 'selected' : '' }}>
                        {{ $t->kode_transaksi }} - {{ $t->deskripsi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Akun</label>
            <select name="akun_id" class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
                <option value=""> Pilih Akun </option>
                @foreach($akun as $a)
                    <option value="{{ $a->id }}" {{ old('akun_id') == $a->id ? 'selected' : '' }}>
                        {{ $a->kode_akun }} - {{ $a->nama_akun }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Debit</label>
                <input type="number" name="debit" value="{{ old('debit') }}" 
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="0">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kredit</label>
                <input type="number" name="kredit" value="{{ old('kredit') }}" 
                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="0">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
            <textarea name="keterangan" rows="3" 
                class="w-full border border-gray-300 rounded-lg p-2.5 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                placeholder="Masukkan keterangan...">{{ old('keterangan') }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('bendahara.detailTs') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition">
               <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit"
               class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition">
               <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>
</div>

@endsection
