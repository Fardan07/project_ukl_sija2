@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Statistik Laporan Kerusakan</h1>
        <p class="text-gray-400 mt-1">Jumlah laporan kerusakan per bulan</p>
    </div>

    <div class="flex items-center gap-3">
        <select class="px-3 py-2 border border-gray-200 rounded-lg text-sm">
            <option>2026</option>
            <option>2025</option>
            <option>2024</option>
        </select>

        <a href="{{ route('admin.dashboard') }}"
            class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-gray-600 hover:bg-gray-50">
            ← Kembali
        </a>
    </div>
</div>
    <!--Jumlah TANPA GRAFIK-->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <p class="text-sm text-gray-500">Total Laporan</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                {{ $totalLaporan }}
        </h2>
        <p class="text-xs text-gray-400 mt-2">Semua laporan masuk</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <p class="text-sm text-gray-500">Laporan Bulan Ini</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                {{ $laporanBulanIni }}
        </h2>
        <p class="text-xs text-green-500 mt-2">▲ 13.3% dari bulan lalu</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <p class="text-sm text-gray-500">Laporan Selesai</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-2">95</h2>
        <p class="text-xs text-green-500 mt-2">74.2% dari total laporan</p>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <p class="text-sm text-gray-500">Laporan Diproses</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-2">33</h2>
        <p class="text-xs text-orange-500 mt-2">25.8% dari total laporan</p>
    </div>

</div>
        <!--N-->

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

    <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-gray-800">
                Jumlah Laporan Kerusakan per Bulan
            </h3>

            <select class="border border-gray-200 rounded-lg px-3 py-2 text-sm">
                <option>Total Laporan</option>
            </select>
        </div>

        <canvas id="laporanChart" height="120"></canvas>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-800 mb-4">
            Status Laporan
        </h3>

        <canvas id="statusChart"></canvas>

        <div class="mt-5 space-y-2 text-sm">
            <div class="flex justify-between">
                <span>Selesai</span>
                <span>95 (74.2%)</span>
            </div>

            <div class="flex justify-between">
                <span>Diproses</span>
                <span>33 (25.8%)</span>
            </div>

            <div class="flex justify-between">
                <span>Ditolak</span>
                <span>0 (0%)</span>
            </div>

            <hr class="my-2">

            <div class="flex justify-between font-semibold">
                <span>Total</span>
                <span>128</span>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <div class="xl:col-span-2 bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-800 mb-5">
            5 Kategori Kerusakan Terbanyak
        </h3>

        <div class="space-y-4">

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Meja Rusak</span>
                    <span>35</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[100%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Kursi Rusak</span>
                    <span>28</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[80%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Lampu Mati</span>
                    <span>21</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[60%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>Pintu Rusak</span>
                    <span>15</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[40%]"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>AC Rusak</span>
                    <span>10</span>
                </div>
                <div class="h-2 bg-gray-100 rounded-full">
                    <div class="h-2 bg-red-500 rounded-full w-[30%]"></div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm">
        <h3 class="font-semibold text-gray-800 mb-4">Informasi</h3>

        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">
            <p class="text-sm text-gray-700">
                Data statistik diperbarui otomatis setiap hari.
            </p>

            <p class="text-xs text-gray-500 mt-2">
                Terakhir diperbarui: 6 Juni 2026, 10:51 WIB
            </p>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const laporanCtx = document.getElementById('laporanChart');

new Chart(laporanCtx, {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        datasets: [{
            data: [12,20,15,24,13,18,9,16,14,22,17,16],
            backgroundColor: '#3B82F6',
            borderRadius: 6
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

const statusCtx = document.getElementById('statusChart');

new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Selesai','Diproses'],
        datasets: [{
            data: [95,33],
            backgroundColor: [
                '#22C55E',
                '#F97316'
            ]
        }]
    },
    options: {
        cutout: '65%'
    }
});
</script>

@endsection