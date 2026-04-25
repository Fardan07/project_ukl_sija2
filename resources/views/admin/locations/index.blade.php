@extends('layouts.admin')

@section('title', 'Manajemen Lokasi')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Lokasi</h1>
        <p class="text-sm text-gray-400 mt-0.5">Kelola data lokasi fasilitas di sekolah.</p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center gap-3">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    {{-- FORM TAMBAH --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-8">
        <h2 class="font-bold text-gray-800 border-b pb-3 mb-4">Tambah Lokasi Baru</h2>

        <form action="{{ route('admin.locations.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400 tracking-wider block mb-1">Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" class="w-full border border-gray-200 rounded-lg p-2.5 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition text-sm" placeholder="Contoh: Ruang Kelas XI SIJA 2" required>
                </div>

                <div>
                    <label class="text-[10px] font-bold uppercase text-gray-400 tracking-wider block mb-1">Keterangan</label>
                    <input type="text" name="keterangan" class="w-full border border-gray-200 rounded-lg p-2.5 focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition text-sm" placeholder="Contoh: Gedung A Lantai 2">
                </div>
            </div>

            <button type="submit" class="mt-5 bg-gray-800 hover:bg-black text-white font-semibold px-5 py-2.5 rounded-lg text-sm transition active:scale-95">
                Simpan Lokasi
            </button>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest w-12">#</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nama Lokasi</th>
                        <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Keterangan</th>
                        <th class="p-4 text-center text-[10px] font-bold uppercase text-gray-400 tracking-widest w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    @forelse($locations as $location)
                    <tr class="hover:bg-gray-50/50 transition group">
                        <td class="p-4 text-gray-500">{{ $loop->iteration }}</td>

                        {{-- EDIT FORM INLINE --}}
                        <form action="{{ route('admin.locations.update', $location->id) }}" method="POST" class="contents">
                            @csrf
                            @method('PUT')

                            <td class="p-4">
                                <input type="text" name="nama_lokasi" value="{{ $location->nama_lokasi }}" class="border border-gray-200 rounded-lg p-2 w-full text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition bg-transparent group-hover:bg-white" required>
                            </td>

                            <td class="p-4">
                                <input type="text" name="keterangan" value="{{ $location->keterangan }}" class="border border-gray-200 rounded-lg p-2 w-full text-sm focus:ring-2 focus:ring-red-500/20 focus:border-red-500 outline-none transition bg-transparent group-hover:bg-white">
                            </td>

                            <td class="p-4 flex gap-2 justify-center items-center mt-1">
                                <button type="submit" class="text-blue-600 hover:text-blue-800 font-semibold text-xs transition px-2 py-1 bg-blue-50 hover:bg-blue-100 rounded border border-blue-100">
                                    Update
                                </button>
                        </form>

                        <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST" onsubmit="return confirm('Yakin hapus lokasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs transition px-2 py-1 bg-red-50 hover:bg-red-100 rounded border border-red-100">
                                Hapus
                            </button>
                        </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-400 italic">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Belum ada data lokasi.
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