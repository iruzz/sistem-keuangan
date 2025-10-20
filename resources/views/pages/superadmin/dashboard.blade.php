@extends('layouts.navbar')

@section('title', 'Dashboard Super Admin')
@section('page-title', 'Dashboard')

@section('sidebar')
   <li>
      <a href="{{ route('superadmin.dashboard') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 group transition">
         <i class="fa-solid fa-house w-5 text-gray-500 group-hover:text-blue-700"></i>
         <span class="ms-3 font-medium">Dashboard</span>
      </a>
   </li>

   <li>
      <a href="{{ route('superadmin.users') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 group transition">
         <i class="fa-solid fa-user w-5 text-gray-500 group-hover:text-blue-700"></i>
         <span class="ms-3 font-medium">Users</span>
      </a>
   </li>

   <li>
      <a href="{{ route('superadmin.akun') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 group transition">
         <i class="fa-solid fa-wallet w-5 text-gray-500 group-hover:text-blue-700"></i>
         <span class="ms-3 font-medium">Akun Keuangan</span>
      </a>
   </li>

   <li>
      <a href="{{ route('superadmin.kategori') }}"
         class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 group transition">
         <i class="fa-solid fa-tags w-5 text-gray-500 group-hover:text-blue-700"></i>
         <span class="ms-3 font-medium">Kategori Transaksi</span>
      </a>
   </li>
@endsection

@section('content')
<div class="space-y-10">

    {{-- WELCOME CARD --}}
    <div class="bg-gradient-to-r from-blue-400 to-purple-400 text-white p-8 rounded-3xl shadow-lg flex flex-col sm:flex-row items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            <div class="w-20 h-20 flex items-center justify-center bg-white/20 backdrop-blur-md text-3xl font-extrabold rounded-full shadow-inner">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <h2 class="text-2xl sm:text-3xl font-semibold leading-snug">Selamat datang, <span class="font-bold">{{ Auth::user()->name }}</span> 👋</h2>
                <p class="text-blue-100 mt-1">Email: {{ Auth::user()->email }}</p>
                <p class="text-sm italic opacity-90">Role: {{ Auth::user()->getRoleNames()->join(', ') }}</p>
            </div>
        </div>
        <div class="hidden sm:block">
            <i class="fa-solid fa-crown text-6xl opacity-60"></i>
        </div>
    </div>

    {{-- STATISTIC CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $cards = [
                ['label'=>'Total Pengguna', 'value'=>\App\Models\User::count(), 'icon'=>'fa-users', 'color'=>'indigo'],
                ['label'=>'Total Role', 'value'=>\Spatie\Permission\Models\Role::count(), 'icon'=>'fa-user-tag', 'color'=>'green'],
                ['label'=>'Total Permissions', 'value'=>\Spatie\Permission\Models\Permission::count(), 'icon'=>'fa-shield-halved', 'color'=>'yellow'],
                ['label'=>'Total Akun Keuangan', 'value'=>\App\Models\Akun::count(), 'icon'=>'fa-coins', 'color'=>'blue']
            ];
        @endphp

        @foreach ($cards as $c)
        <div class="bg-white rounded-2xl p-6 flex items-center gap-5 shadow-sm hover:shadow-xl border-l-4 border-{{ $c['color'] }}-500 transition-all duration-300 hover:-translate-y-1">
            <div class="w-14 h-14 flex items-center justify-center bg-{{ $c['color'] }}-500/10 text-{{ $c['color'] }}-600 rounded-full">
                <i class="fas {{ $c['icon'] }} text-2xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">{{ $c['label'] }}</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $c['value'] }}</h3>
            </div>
        </div>
        @endforeach
    </div>

    {{-- CHART SECTION --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Chart: User Growth --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center border-b pb-2">📈 Pertumbuhan User per Bulan</h3>
            <div class="flex justify-center items-center" style="height: 320px;">
                <canvas id="userGrowthChart" class="max-w-[95%]"></canvas>
            </div>
        </div>

        {{-- Chart: Role Distribution --}}
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 hover:shadow-lg transition">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 text-center border-b pb-2">🧩 Distribusi Role Pengguna</h3>
            <div class="flex justify-center items-center" style="height: 320px;">
                <canvas id="roleChart" class="max-w-[280px] max-h-[280px]"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const roleLabels = {!! json_encode(\Spatie\Permission\Models\Role::pluck('name')) !!};
    const roleCounts = {!! json_encode(
        \Spatie\Permission\Models\Role::withCount('users')->pluck('users_count')
    ) !!};

    // Distribusi Role
    new Chart(document.getElementById('roleChart'), {
        type: 'doughnut',
        data: {
            labels: roleLabels.length ? roleLabels : ['Tidak ada data'],
            datasets: [{
                data: roleCounts.length ? roleCounts : [1],
                backgroundColor: ['#3b82f6', '#22c55e', '#facc15', '#ef4444', '#8b5cf6', '#14b8a6']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: { 
                legend: { position: 'bottom', labels: { font: { size: 12 } } } 
            }
        }
    });

    // Pertumbuhan User per Bulan
    const userGrowthLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    const userGrowthData = {!! json_encode(
        \App\Models\User::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
        ->whereYear('created_at', date('Y'))
        ->groupBy('bulan')
        ->pluck('jumlah', 'bulan')
    ) !!};

    const growthData = userGrowthLabels.map((_, i) => userGrowthData[i+1] ?? 0);

    new Chart(document.getElementById('userGrowthChart'), {
        type: 'line',
        data: {
            labels: userGrowthLabels,
            datasets: [{
                label: 'User Baru',
                data: growthData,
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#6366f1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: { 
                y: { beginAtZero: true, ticks: { stepSize: 1 } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
