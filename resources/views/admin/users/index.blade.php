@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar User & Role</h1>
                <p class="text-sm text-gray-400 mt-0.5">Pantau user yang terdaftar dan atur jabatan mereka.</p>
            </div>
            
            <form action="{{ route('admin.users.index') }}" method="GET" class="w-full md:w-80 relative">
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

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border border-green-100 flex items-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="p-4 text-left text-[10px] font-bold uppercase text-gray-400 tracking-widest">Informasi User</th>
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
                                <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full text-[11px] font-bold uppercase border border-red-100">
                                    {{ $user->position->nama_jabatan ?? 'Belum Ada' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="flex gap-2">
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
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
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
                            <td colspan="4" class="p-12 text-center text-gray-400 italic">
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
        </div>
    </div>
@endsection