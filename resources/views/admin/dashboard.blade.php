@extends('layouts.admin')

@section('title', 'Data Laporan')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Semua Laporan</h1>
            <p class="text-sm text-gray-400 mt-0.5">FacSchool Report — Panel Admin</p>
        </div>

        <form action="{{ route('admin.laporan.index') }}" method="GET" class="w-full md:w-80 relative">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Cari nama pelapor atau deskripsi..." 
                   class="w-full pl-10 pr-10 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition shadow-sm">
            
            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>

            @if(request('search'))
                <a href="{{ route('admin.laporan.index') }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            @endif
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest w-10">#</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nama</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Kategori</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Lokasi</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Urgensi</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Status</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Tanggal</th>
                        <th class="p-4 text-center text-[10px] font-bold uppercase text-gray-400 tracking-widest min-w-[200px]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse($reports as $report)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="p-4 text-gray-500">{{ $loop->iteration }}</td>
                        
                        <td class="p-4 font-medium text-gray-800">
                            {{ $report->user->name ?? 'Anonim' }}
                        </td>
                        
                        <td class="p-4 text-gray-600">
                            {{ $report->facility->nama_kategori ?? $report->facility->nama_fasilitas ?? '-' }}
                        </td>
                        
                        <td class="p-4 text-gray-600">
                            {{ $report->location->nama_lokasi ?? '-' }}
                        </td>

                        <td class="p-4">
                            @if($report->urgensi == 'darurat')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-red-50 text-red-700 rounded-md text-[11px] font-bold border border-red-100 uppercase">
                                    ⚡ Darurat
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-gray-50 text-gray-500 rounded-md text-[11px] font-bold border border-gray-200 uppercase">
                                    Normal
                                </span>
                            @endif
                        </td>

                        <td class="p-4">
                            <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase border 
                                {{ $report->status == 'selesai' ? 'bg-green-50 text-green-600 border-green-100' : 
                                  ($report->status == 'proses' ? 'bg-blue-50 text-blue-600 border-blue-100' : 'bg-yellow-50 text-yellow-600 border-yellow-100') }}">
                                {{ $report->status ?? 'Pending' }}
                            </span>
                        </td>

                        <td class="p-4 text-gray-500 text-xs">
                            {{ $report->created_at->format('d M Y') }}
                        </td>

                        <td class="p-4 flex gap-2 justify-center items-center">
                            <a href="{{ route('admin.laporan.show', $report->id) }}" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-[11px] font-bold rounded transition">
                                View
                            </a>
                            
                            <form action="{{ route('admin.laporan.updateStatus', $report->id) }}" method="POST" class="contents">
                                @csrf
                                <input type="hidden" name="status" value="proses">
                                <button type="submit" class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 border border-blue-100 text-blue-600 text-[11px] font-bold rounded transition">
                                    Proses
                                </button>
                            </form>

                            <form action="{{ route('admin.laporan.updateStatus', $report->id) }}" method="POST" class="contents">
                                @csrf
                                <input type="hidden" name="status" value="selesai">
                                <button type="submit" class="px-3 py-1.5 bg-green-50 hover:bg-green-100 border border-green-100 text-green-600 text-[11px] font-bold rounded transition">
                                    Selesai
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-12 text-center text-gray-400 italic">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                @if(request('search'))
                                    Laporan dengan kata kunci "<b>{{ request('search') }}</b>" tidak ditemukan.
                                @else
                                    Belum ada laporan yang masuk.
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection