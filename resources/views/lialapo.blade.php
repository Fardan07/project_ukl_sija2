<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Saya — FacSchool Report</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: { primary: '#B91C1C', accent: '#EF4444', dark: '#1C0A0A' },
        fontFamily: { heading: ['Syne', 'sans-serif'], body: ['Plus Jakarta Sans', 'sans-serif'] }
      }
    }
  }
</script>
<style>
  * { font-family: 'Plus Jakarta Sans', sans-serif; }
  h1,h2,h3,.font-heading { font-family: 'Syne', sans-serif; }
  .hero-bg { background: linear-gradient(135deg, #7f1d1d 0%, #991B1B 50%, #B91C1C 100%); }
  ::-webkit-scrollbar { width: 6px; }
  ::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
</style>
</head>

<body class="bg-gray-50 overflow-hidden" style="color:#1C0A0A">
<div class="flex flex-col h-screen">

    <header class="flex-shrink-0 relative z-50">
        <nav class="hero-bg shadow-lg border-b border-white/10">
          <div class="max-w-full mx-auto px-4 md:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
              <button id="mobileMenuBtn" class="md:hidden text-white focus:outline-none p-1">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
              </button>
              
              <div class="w-8 h-8 md:w-9 md:h-9 bg-white rounded-xl flex items-center justify-center shadow">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
              </div>
              <div class="hidden sm:block">
                <p class="font-heading text-white text-sm md:text-base font-bold leading-none">FacSchool Report</p>
                <p class="text-[10px] leading-none mt-0.5" style="color:rgba(255,255,255,0.5)">Portal Lapor Fasilitas</p>
              </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-white text-xs md:text-sm font-medium">Halo, {{ auth()->user()->name }}</span>
            </div>
          </div>
        </nav>
    </header>

    <div class="flex flex-1 overflow-hidden relative">

        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

        <aside id="sidebar" class="absolute md:relative z-50 w-64 bg-white border-r border-gray-200 flex flex-col h-full flex-shrink-0 transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0">
            <button id="sidebarToggle" class="hidden md:flex absolute -right-5 top-8 w-10 h-10 bg-white border border-gray-200 text-gray-400 hover:text-red-600 rounded-full items-center justify-center shadow-sm transition-all duration-300 focus:outline-none z-50">
                <svg id="toggleIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-800 whitespace-nowrap">Menu Utama</h2>
                    <p class="text-xs text-gray-400 whitespace-nowrap">Dashboard Siswa / Guru</p>
                </div>
                <button id="closeSidebarBtn" class="md:hidden text-gray-400 hover:text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm overflow-y-auto overflow-x-hidden">
                <a href="{{ route('landing') }}" class="block px-4 py-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium whitespace-nowrap transition-colors">← Halaman Utama</a>
                <div class="border-t my-4 border-gray-100"></div>
                <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl bg-red-50 text-red-700 font-medium whitespace-nowrap transition-colors">📁 Laporan Saya</a>
                <a href="{{ route('landing') }}#form-laporan" class="block px-4 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-700 text-gray-600 font-medium whitespace-nowrap transition-colors">➕ Buat Laporan Baru</a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full bg-red-600 text-white py-2.5 rounded-xl font-bold text-sm hover:bg-red-700 transition shadow-sm whitespace-nowrap">Logout</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-4 md:p-10 relative">
            <div class="max-w-5xl mx-auto">
                
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                @endif

                <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                    <div>
                        <h1 class="font-heading text-2xl md:text-3xl font-bold text-gray-800">Daftar Laporan Saya</h1>
                        <p class="text-xs md:text-sm text-gray-500 mt-2">Pantau status laporan kerusakan fasilitas yang telah kamu kirim.</p>
                    </div>
                    <a href="{{ route('landing') }}#form-laporan" class="w-full md:w-auto text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition-colors shadow-sm whitespace-nowrap">
                        + Buat Laporan
                    </a>
                </div>

                <div class="space-y-4">
    @forelse ($reports as $report)
    <div class="bg-white border border-gray-100 rounded-2xl p-4 md:p-5 shadow-sm flex flex-col md:flex-row gap-4 md:gap-6 items-start md:items-center">
        
        <div class="flex-shrink-0 w-full md:w-32 h-32 rounded-xl overflow-hidden bg-gray-100 border border-gray-200 relative cursor-pointer" onclick="openModal('modal-{{ $report->id }}')">
            <img src="{{ $report->foto ? asset('storage/'.$report->foto) : asset('img/image.png') }}" class="w-full h-full object-cover">
        </div>

        <div class="flex-1 w-full">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                
                <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[9px] text-gray-400 font-bold uppercase mb-0.5">Status</p>
                    @if($report->status === 'selesai')
                        <span class="text-xs font-bold text-green-600">✅ Selesai</span>
                    @elseif($report->status === 'proses')
                        <span class="text-xs font-bold text-blue-600">⏳ Diproses</span>
                    @else
                        <span class="text-xs font-bold text-yellow-600">🕒 Antrean</span>
                    @endif
                </div>

                <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[9px] text-gray-400 font-bold uppercase mb-0.5">Urgensi</p>
                    <span class="text-xs font-bold {{ $report->urgensi == 'darurat' ? 'text-red-600' : 'text-gray-700' }} capitalize">
                        {{ $report->urgensi }}
                    </span>
                </div>

                <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[9px] text-gray-400 font-bold uppercase mb-0.5">Fasilitas</p>
                    <span class="text-xs font-bold text-gray-800 truncate block">
                        {{ $report->facility->nama_kategori ?? '-' }}
                    </span>
                </div>

                <div class="p-2.5 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[9px] text-gray-400 font-bold uppercase mb-0.5">Lokasi</p>
                    <span class="text-xs font-bold text-gray-800 truncate block">
                        {{ $report->location->nama_lokasi ?? '-' }}
                    </span>
                </div>

            </div>

            <div class="flex justify-between items-center border-t border-gray-50 pt-3">
                <span class="text-[11px] text-gray-400">Dibuat: {{ $report->created_at->diffForHumans() }}</span>
                <button onclick="openModal('modal-{{ $report->id }}')" class="inline-flex items-center gap-1 text-xs font-bold text-blue-600 hover:text-blue-800 transition-colors">
                    Lihat Detail Laporan
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div id="modal-{{ $report->id }}" class="fixed inset-0 z-[99999] flex items-center justify-center hidden opacity-0 transition-opacity duration-300 p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('modal-{{ $report->id }}')"></div>
        <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative z-10 shadow-2xl transform scale-95 transition-transform duration-300" id="content-{{ $report->id }}">
            
            <div class="flex items-center justify-between p-4 md:p-6 border-b border-gray-100 sticky top-0 bg-white z-20">
                <div>
                    <h3 class="font-heading text-lg md:text-xl font-bold text-gray-800">Detail Laporan</h3>
                    <p class="text-[10px] md:text-xs text-gray-400 mt-1">Dilaporkan pada {{ $report->created_at->format('d F Y, H:i') }}</p>
                </div>
                <button onclick="closeModal('modal-{{ $report->id }}')" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-red-100 text-gray-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-4 md:p-6">
                @if($report->foto)
                    <img src="{{ asset('storage/'.$report->foto) }}" class="w-full max-h-48 md:max-h-80 object-contain bg-gray-100 rounded-xl mb-6">
                @endif
                
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Status Laporan</p>
                        <p class="font-bold text-xs md:text-sm capitalize">
                            {{ $report->status == 'proses' ? 'Sedang Diproses' : ($report->status == 'selesai' ? 'Selesai' : 'Menunggu Antrean') }}
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Urgensi</p>
                        <p class="font-bold text-xs md:text-sm {{ $report->urgensi == 'darurat' ? 'text-red-600' : 'text-gray-800' }} capitalize">{{ $report->urgensi }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Fasilitas</p>
                        <p class="font-bold text-xs md:text-sm">{{ $report->facility->nama_kategori ?? '-' }}</p>
                    </div>
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Lokasi Ruangan</p>
                        <p class="font-bold text-xs md:text-sm">{{ $report->location->nama_lokasi ?? '-' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-2">Deskripsi Kerusakan dari Kamu</p>
                    <p class="text-xs md:text-sm text-gray-700 bg-gray-50 p-4 rounded-xl border border-gray-100">{{ $report->deskripsi }}</p>
                </div>

                @if($report->catatan_admin || $report->foto_perbaikan || $report->status !== 'belum')
                <div class="mt-6 border-t border-gray-100 pt-6">
                    <p class="text-[10px] text-blue-600 font-bold uppercase tracking-wider mb-3">Tanggapan & Progres Admin Sarpras</p>
                    <div class="bg-blue-50/70 p-4 md:p-5 rounded-xl border border-blue-100">
                        <p class="text-xs font-semibold text-blue-900 mb-2">
                            Status Terkini: <span class="underline capitalize">{{ $report->status == 'proses' ? 'Sedang Dikerjakan tim Sarpras' : ($report->status == 'selesai' ? 'Sudah Diperbaiki' : 'Laporan Diterima') }}</span>
                        </p>
                        
                        @if($report->catatan_admin)
                            <div class="text-xs md:text-sm text-blue-800 bg-white/80 p-3 rounded-lg border border-blue-200/50 italic">
                                "{{ $report->catatan_admin }}"
                            </div>
                        @else
                            <p class="text-xs text-blue-700/60 italic">Belum ada catatan tertulis dari admin.</p>
                        @endif

                        @if($report->foto_perbaikan)
                            <div class="mt-4">
                                <p class="text-[10px] text-blue-700 font-bold uppercase mb-1.5">Foto Bukti Perbaikan Selesai:</p>
                                <img src="{{ asset('storage/'.$report->foto_perbaikan) }}" class="w-full max-h-48 object-cover rounded-lg border border-blue-200 shadow-xs">
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    @empty
    <div class="bg-white border border-gray-100 rounded-2xl p-8 text-center">
        <p class="text-gray-500 text-sm">Belum ada riwayat laporan yang kamu kirimkan.</p>
    </div>
    @endforelse
</div>
                
                @if($reports->hasPages())
                <div class="mt-8">{{ $reports->links() }}</div>
                @endif
            </div>
        </main>
    </div>
</div>

<script>
    // Script Logika Buka-Tutup Sidebar Mobile & Desktop
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const closeBtn = document.getElementById('closeSidebarBtn');
    
    // Toggle untuk Mobile
    mobileBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Toggle untuk Desktop (seperti sebelumnya)
    const sidebarToggle = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');
    if(sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('md:-ml-64');
            if (sidebar.classList.contains('md:-ml-64')) {
                toggleIcon.classList.add('rotate-180');
                sidebarToggle.classList.add('translate-x-8', 'bg-red-600', 'text-white', 'border-red-600');
                sidebarToggle.classList.remove('bg-white', 'text-gray-400');
            } else {
                toggleIcon.classList.remove('rotate-180');
                sidebarToggle.classList.remove('translate-x-8', 'bg-red-600', 'text-white', 'border-red-600');
                sidebarToggle.classList.add('bg-white', 'text-gray-400');
            }
        });
    }

    // Modal Logika (Tidak Berubah)
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId.replace('modal-', 'content-'));
        modal.classList.remove('hidden');
        setTimeout(() => { modal.classList.remove('opacity-0'); content.classList.remove('scale-95'); }, 10);
    }
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const content = document.getElementById(modalId.replace('modal-', 'content-'));
        modal.classList.add('opacity-0'); content.classList.add('scale-95');
        setTimeout(() => { modal.classList.add('hidden'); }, 300);
    }
</script>
</body>
</html>