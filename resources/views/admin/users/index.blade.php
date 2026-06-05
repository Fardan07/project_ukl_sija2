@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar User & Role</h1>
                <p class="text-sm text-gray-400 mt-0.5">Pantau user yang terdaftar dan atur jabatan mereka.</p>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data" class="m-0" id="importExcelForm">
                    @csrf
                    <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2.5 bg-gray-800 text-white rounded-xl text-sm font-semibold hover:bg-black transition active:scale-95 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span>Impor Excel</span>
                        <input type="file" name="file" class="hidden" accept=".xlsx, .xls, .csv" onchange="document.getElementById('importExcelForm').submit();">
                    </label>
                </form>

                <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-80 relative m-0">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari nama atau email user..." 
                           class="w-full pl-10 pr-10 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition shadow-sm">
                    
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border border-red-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Informasi User</th>
                            <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Kelas</th>
                            <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Jabatan Saat Ini</th>
                            <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Update Role</th>
                            <th class="p-4 text-center text-[10px] font-bold uppercase text-gray-400 tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4">
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-semibold text-gray-600 text-xs uppercase tracking-wider">
                                    {{-- Filter agar hanya memproses tampilan kelas untuk siswa --}}
                                    @if($user->role === 'siswa')
                                        @if($user->class_name)
                                            {{ $user->class_name }}
                                        @else
                                            <span class="text-red-500/80 font-medium normal-case italic text-[11px]">Kelas tidak ditemukan</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 font-normal normal-case italic text-[11px]">Bukan Siswa</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">
                                {{-- Menampilkan teks role/jabatan langsung --}}
                                <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full text-[11px] font-bold uppercase border border-red-100">
                                    {{ $user->role === 'siswa' ? 'Murid' : ($user->role ?? 'Belum Ada') }}
                                </span>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="flex gap-2 m-0">
                                    @csrf
                                    @method('PUT')
                                    
                                    <select name="position_id" class="text-xs border border-gray-200 rounded-lg px-2 py-1.5 bg-white outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition cursor-pointer">
                                        @foreach($positions as $p)
                                            <option value="{{ $p->id }}" {{ $user->position_id == $p->id ? 'selected' : '' }}>
                                                {{ $p->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold hover:bg-black transition active:scale-95">
                                        Simpan
                                    </button>
                                </form>
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')" class="m-0">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="text-gray-300 hover:text-red-600 transition p-2">
                                        <svg class="w-5 h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 15.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    @if(request('search'))
                                        Data user dengan kata kunci "<b>{{ request('search') }}</b>" tidak ditemukan.
                                    @else
                                        Data user tidak ditemukan.
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex items-center justify-between">
                    <div class="text-xs text-gray-500 font-medium">
                        Menampilkan <span class="font-bold text-gray-700">{{ $users->firstItem() }}</span> sampai <span class="font-bold text-gray-700">{{ $users->lastItem() }}</span> dari <span class="font-bold text-gray-700">{{ $users->total() }}</span> user
                    </div>
                    
                    <div class="flex items-center gap-1.5">
                        @if ($users->onFirstPage())
                            <span class="px-2.5 py-1.5 bg-white border border-gray-200 rounded-lg text-gray-300 text-xs font-semibold cursor-not-allowed select-none">Sebelumnya</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="px-2.5 py-1.5 bg-white border border-gray-200 rounded-lg text-gray-600 text-xs font-semibold hover:bg-gray-50 hover:text-black transition active:scale-95">Sebelumnya</a>
                        @endif

                        @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="px-3 py-1.5 bg-gray-800 text-white rounded-lg text-xs font-bold shadow-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-xs font-semibold hover:bg-gray-50 hover:text-black transition">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="px-2.5 py-1.5 bg-white border border-gray-200 rounded-lg text-gray-600 text-xs font-semibold hover:bg-gray-50 hover:text-black transition active:scale-95">Selanjutnya</a>
                        @else
                            <span class="px-2.5 py-1.5 bg-white border border-gray-200 rounded-lg text-gray-300 text-xs font-semibold cursor-not-allowed select-none">Selanjutnya</span>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div id="loadingOverlay" class="hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-[9999] flex flex-col items-center justify-center transition-all duration-300">
        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 flex flex-col items-center max-w-xs text-center">
            <div class="relative w-16 h-16 mb-4">
                <div class="w-16 h-16 rounded-full border-4 border-gray-100 absolute inset-0"></div>
                <div class="w-16 h-16 rounded-full border-4 border-t-red-600 border-r-transparent border-b-transparent border-l-transparent absolute inset-0 animate-spin"></div>
            </div>
            <h3 class="text-gray-800 font-bold text-base mb-1">Memproses Data...</h3>
            <p class="text-gray-400 text-xs px-2">Mohon tunggu sebentar, sistem sedang membaca file Excel dan mengamankan akun.</p>
        </div>
    </div>

    <script>
        const importForm = document.getElementById('importExcelForm');
        const loadingOverlay = document.getElementById('loadingOverlay');

        if (importForm) {
            importForm.addEventListener('submit', function() {
                loadingOverlay.classList.remove('hidden');
            });
        }
    </script>
@endsection