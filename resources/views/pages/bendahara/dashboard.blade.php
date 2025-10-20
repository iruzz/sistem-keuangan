@extends('layouts.navbar')

@section('title', 'Dashboard Bendahara')

@section('sidebar')
<li>
    <a href="{{ route('bendahara.dashboard') }}"
        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
        <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-600"></i>
        <span class="ms-3 font-medium">Dashboard</span>
    </a>
</li>
<li>
    <a href="{{ route('bendahara.akun') }}"
        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
        <i class="fa-solid fa-wallet w-5 text-gray-500 group-hover:text-blue-600"></i>
        <span class="ms-3 font-medium">Akun Keuangan</span>
    </a>
</li>
<li>
    <a href="{{ route('bendahara.kasBank') }}"
        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
        <i class="fa-solid fa-piggy-bank w-5 text-gray-500 group-hover:text-blue-600"></i>
        <span class="ms-3 font-medium">Kas/Bank</span>
    </a>
</li>
<li>
    <a href="{{ route('bendahara.transaksi') }}"
        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
        <i class="fa-solid fa-receipt w-5 text-gray-500 group-hover:text-blue-600"></i>
        <span class="ms-3 font-medium">Transaksi</span>
    </a>
</li>
<li>
    <a href="{{ route('bendahara.detailTs') }}"
        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition">
        <i class="fa-solid fa-list w-5 text-gray-500 group-hover:text-blue-600"></i>
        <span class="ms-3 font-medium">Detail Transaksi</span>
    </a>
</li>
@endsection

@section('content')
<div class="space-y-8">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
        $cards = [
            ['label' => 'Total Saldo Kas/Bank', 'value' => 'Rp '.number_format($totalSaldo ?? 0, 0, ',', '.'), 'desc' => $jumlahKasBank.' rekening aktif', 'color' => 'blue'],
            ['label' => 'Total Pemasukan', 'value' => 'Rp '.number_format($totalPemasukan ?? 0, 0, ',', '.'), 'desc' => '✓ Bulan ini', 'color' => 'green'],
            ['label' => 'Total Pengeluaran', 'value' => 'Rp '.number_format($totalPengeluaran ?? 0, 0, ',', '.'), 'desc' => '✗ Bulan ini', 'color' => 'red'],
            ['label' => 'Total Transaksi', 'value' => $jumlahTransaksi, 'desc' => 'Semua transaksi', 'color' => 'indigo']
        ];
        @endphp

        @foreach ($cards as $card)
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">{{ $card['label'] }}</p>
                    <h3 class="text-2xl font-bold text-{{ $card['color'] }}-600 mt-2">{{ $card['value'] }}</h3>
                    <p class="text-xs text-{{ $card['color'] }}-600 mt-2">{{ $card['desc'] }}</p>
                </div>
                <div class="p-3 bg-{{ $card['color'] }}-100 rounded-xl">
                    <i class="fa-solid fa-chart-simple text-{{ $card['color'] }}-600 text-xl"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Charts Row 1 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Bar Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Perbandingan Pemasukan & Pengeluaran</h3>
            <div style="position: relative; height: 300px;">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4 text-center">Distribusi Kas/Bank</h3>
            <div class="flex justify-center items-center" style="height: 300px;">
                <canvas id="donutChart" style="max-width: 280px; max-height: 280px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Line Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tren Keuangan Bulanan</h3>
            <div style="position: relative; height: 300px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Selisih Pemasukan & Pengeluaran</h3>
            <div style="position: relative; height: 300px;">
                <canvas id="areaChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Transaksi Terbaru -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b">
            <h3 class="text-lg font-semibold text-gray-900">Transaksi Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-3">Kode</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Deskripsi</th>
                        <th class="px-6 py-3">Tipe</th>
                        <th class="px-6 py-3">Jumlah</th>
                        <th class="px-6 py-3">User Input</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($transaksiTerbaru ?? [] as $transaksi)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3 font-semibold">{{ $transaksi->kode_transaksi }}</td>
                        <td class="px-6 py-3">{{ $transaksi->tanggal->format('d M Y') }}</td>
                        <td class="px-6 py-3">{{ Str::limit($transaksi->deskripsi, 25) }}</td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $transaksi->tipe === 'Pemasukan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $transaksi->tipe }}
                            </span>
                        </td>
                        <td class="px-6 py-3 font-bold {{ $transaksi->tipe === 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $transaksi->tipe === 'Pemasukan' ? '+' : '-' }}Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="font-medium text-gray-900">{{ $transaksi->user->name ?? 'N/A' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t">
            <a href="{{ route('bendahara.transaksi') }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm flex items-center gap-1">
                → Lihat semua transaksi
            </a>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const rupiah = v => 'Rp ' + v.toLocaleString('id-ID');

    // Bar Chart (Total)
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                label: 'Jumlah (Rp)',
                data: [{{ $totalPemasukan ?? 0 }}, {{ $totalPengeluaran ?? 0 }}],
                backgroundColor: ['#16a34a', '#dc2626'],
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { callback: rupiah } } }
        }
    });

    // Doughnut Chart (KasBank)
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($kasBankList->pluck('nama_rekening')) !!},
            datasets: [{
                data: {!! json_encode($kasBankList->pluck('saldo')) !!},
                backgroundColor: ['#3b82f6', '#facc15', '#22c55e', '#ef4444', '#8b5cf6']
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Line Chart (Tren Bulanan)
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($bulanLabels) !!},
            datasets: [
                {
                    label: 'Pemasukan',
                    data: {!! json_encode($pemasukkanBulanan) !!},
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.1)',
                    tension: 0.4,
                    borderWidth: 2
                },
                {
                    label: 'Pengeluaran',
                    data: {!! json_encode($pengeluaranBulanan) !!},
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.1)',
                    tension: 0.4,
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'top' } },
            scales: { y: { beginAtZero: true, ticks: { callback: rupiah } } }
        }
    });

    // Area Chart (Selisih)
    new Chart(document.getElementById('areaChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($bulanLabels) !!},
            datasets: [{
                label: 'Selisih (Pemasukan - Pengeluaran)',
                data: {!! json_encode($selisihBulanan) !!},
                fill: true,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                tension: 0.4,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: true } },
            scales: { y: { beginAtZero: true, ticks: { callback: rupiah } } }
        }
    });
</script>
@endsection