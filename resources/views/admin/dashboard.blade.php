@extends('layouts.admin')

@section('title', 'Data Laporan')

@section('content')
<div class="max-w-7xl mx-auto">

    <!-- Header & Search Bar -->
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

    <!-- Alert Success -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center gap-3">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tabel Data -->
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
                        <th class="p-4 text-center text-[10px] font-bold uppercase text-gray-400 tracking-widest min-w-[150px]">Aksi</th>
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
                            
                            <!-- TOMBOL TRIGGER MODAL UPDATE -->
                            <button onclick="document.getElementById('modalUpdate-{{ $report->id }}').classList.remove('hidden')" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 border border-red-100 text-red-600 text-[11px] font-bold rounded transition">
                                Update
                            </button>
                        </td>
                    </tr>

                    <!-- ========================================== -->
                    <!-- MODAL UPDATE STATUS ADMIN (ANTI MEPET)     -->
                    <!-- ========================================== -->
                    <div id="modalUpdate-{{ $report->id }}" class="fixed inset-0 z-[99999] flex items-center justify-center hidden p-4 sm:p-6 transition-all duration-300">
                        <!-- Background Gelap -->
                        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="document.getElementById('modalUpdate-{{ $report->id }}').classList.add('hidden')"></div>
                        
                        <!-- Konten Pop-up -->
                        <div class="bg-white rounded-3xl w-full max-w-lg relative z-10 shadow-2xl flex flex-col max-h-[90vh]">
                            
                            <!-- Header Modal -->
                            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center flex-shrink-0 bg-white rounded-t-3xl">
                                <div>
                                    <h3 class="font-bold text-xl text-gray-800">Update Laporan</h3>
                                    <p class="text-xs text-gray-500 mt-1">Perbarui status dan beri info ke pelapor.</p>
                                </div>
                                <button type="button" onclick="document.getElementById('modalUpdate-{{ $report->id }}').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 hover:bg-red-50 text-gray-500 hover:text-red-600 transition-colors focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                            
                            <!-- Form Area (Scrollable & Padded) -->
                            <div class="overflow-y-auto flex-1 p-6 md:p-8">
                                <form action="{{ route('admin.laporan.updateStatus', $report->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                                    @csrf
                                    
                                    <!-- Status -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Ubah Status</label>
                                        <div class="relative">
                                            <select name="status" class="w-full border border-gray-200 rounded-xl pl-4 pr-10 py-3 text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none appearance-none cursor-pointer text-gray-700 bg-gray-50 hover:bg-white transition-colors">
                                                <option value="belum" {{ $report->status == 'belum' ? 'selected' : '' }}>🕒 Belum Diproses</option>
                                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>⏳ Sedang Diproses (Perbaikan)</option>
                                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pesan / Catatan -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Pesan / Catatan Admin</label>
                                        <textarea name="catatan_admin" rows="3" class="w-full border border-gray-200 rounded-xl p-4 text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none bg-gray-50 hover:bg-white transition-colors resize-none text-gray-700" placeholder="Contoh: Tim teknisi sedang memperbaiki fasilitas ini, estimasi selesai besok...">{{ $report->catatan_admin }}</textarea>
                                    </div>

                                    <!-- File Upload -->
                                    <div>
                                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Upload Bukti Perbaikan (Opsional)</label>
                                        <div class="w-full border-2 border-dashed border-gray-200 rounded-xl p-2 bg-gray-50 hover:bg-gray-100 transition-colors group relative cursor-pointer">
                                            <input type="file" name="foto_perbaikan" class="w-full text-sm text-gray-500 
                                                file:mr-4 file:py-2.5 file:px-4 
                                                file:rounded-lg file:border-0 
                                                file:text-xs file:font-bold 
                                                file:bg-red-50 file:text-red-700 
                                                hover:file:bg-red-100 cursor-pointer outline-none transition-colors">
                                        </div>
                                        <p class="text-[10px] text-gray-400 mt-2">*Format yang diizinkan: JPG, PNG, JPEG (Maks. 4MB)</p>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <button type="submit" class="mt-2 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-xl transition-all active:scale-[0.98] shadow-sm flex justify-center items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Simpan Perubahan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

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