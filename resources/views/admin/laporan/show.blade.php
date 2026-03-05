@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

  <!-- Header -->
  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Detail Laporan</h1>
      <p class="text-sm text-gray-400 mt-0.5">FacSchool Report — Panel Admin</p>
    </div>

    <a href="{{ route('admin.dashboard') }}"
       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition">
      ← Kembali
    </a>
  </div>

  <!-- Card -->
  <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-6">

    <!-- Grid Info -->
    <div class="grid grid-cols-2 gap-6">

      <div>
        <p class="text-xs text-gray-400 uppercase">Nama Pelapor</p>
        <p class="text-sm font-medium text-gray-800 mt-1">
          {{ $report->user->name }}
        </p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase">Kategori</p>
        <p class="text-sm font-medium text-gray-800 mt-1">
          {{ $report->facility->nama_fasilitas }}
        </p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase">Lokasi</p>
        <p class="text-sm font-medium text-gray-800 mt-1">
          {{ $report->location->nama_lokasi }}
        </p>
      </div>

      <div>
        <p class="text-xs text-gray-400 uppercase">Status</p>

        @php
        $statusClass = match($report->status) {
          'proses' => 'bg-blue-100 text-blue-700',
          'selesai' => 'bg-green-100 text-green-700',
          default => 'bg-yellow-100 text-yellow-700'
        };
        @endphp

        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold mt-1 {{ $statusClass }}">
          {{ $report->status }}
        </span>

      </div>

    </div>

    <!-- Deskripsi -->
    <div>
      <p class="text-xs text-gray-400 uppercase mb-2">Deskripsi Kerusakan</p>

      <div class="text-sm text-gray-700 leading-relaxed bg-gray-50 border border-gray-200 rounded-lg p-4">
        {{ $report->deskripsi }}
      </div>
    </div>

    <!-- Foto -->
    @if($report->foto)
    <div>
      <p class="text-xs text-gray-400 uppercase mb-3">Foto Kerusakan</p>

      <img src="{{ asset('storage/'.$report->foto) }}"
           class="rounded-lg border border-gray-200 max-w-md">
    </div>
    @endif

  </div>

</div>

@endsection