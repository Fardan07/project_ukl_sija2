<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel — FacSchool Report</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#B91C1C',
          accent: '#EF4444',
          light: '#FEF2F2',
          dark: '#1C0A0A',
        },
        fontFamily: {
          heading: ['Syne', 'sans-serif'],
          body: ['Plus Jakarta Sans', 'sans-serif'],
        }
      }
    }
  }
</script>
<style>
  * { font-family: 'Plus Jakarta Sans', sans-serif; }
  h1,h2,h3,.font-heading { font-family: 'Syne', sans-serif; }

  .hero-bg {
    background: linear-gradient(135deg, #7f1d1d 0%, #991B1B 50%, #B91C1C 100%);
    position: relative;
    overflow: hidden;
  }
  .nav-link { color: rgba(255,255,255,0.75); transition: color 0.2s; text-decoration: none; }
  .nav-link:hover { color: #fca5a5; }
</style>
</head>

<body class="bg-gray-100 overflow-hidden" style="color:#1C0A0A">

<div class="flex flex-col h-screen">

    <header class="flex-shrink-0 relative z-[10000]">
        <nav class="hero-bg shadow-lg border-b border-white/10">
          <div class="max-w-full mx-auto px-6 py-4 flex items-center justify-between">
            
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shadow">
                <svg class="w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
              </div>
              <div>
                <p class="font-heading text-white text-base font-bold leading-none">FacSchool Report</p>
                <p class="text-[10px] leading-none mt-0.5" style="color:rgba(255,255,255,0.5)">Portal Manajemen Sekolah</p>
              </div>
            </div>

            <div class="hidden md:flex items-center gap-8">
              <a href="{{ route('landing') }}#beranda" class="nav-link text-sm font-medium">Beranda Publik</a>
              <a href="{{ route('landing') }}#form-laporan" class="nav-link text-sm font-medium">Buka Form Laporan</a>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-white text-sm font-medium">Halo, {{ auth()->user()->name ?? 'Admin' }}</span>
            </div>

          </div>
        </nav>
    </header>

    <div class="flex flex-1 overflow-hidden relative">

        <aside id="sidebar" class="relative w-64 bg-white border-r border-gray-200 flex flex-col h-full flex-shrink-0 transition-all duration-300 ease-in-out z-50">
            
            <button id="sidebarToggle" class="absolute -right-5 top-8 w-10 h-10 bg-white border border-gray-200 text-gray-400 hover:text-red-600 rounded-full flex items-center justify-center shadow-sm transition-all duration-300 focus:outline-none z-[60]">
                <svg id="toggleIcon" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>

            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 whitespace-nowrap">Admin Panel</h2>
                <p class="text-xs text-gray-400 whitespace-nowrap">Dashboard Kendali</p>
            </div>

            <nav class="flex-1 p-4 space-y-2 text-sm overflow-y-auto overflow-x-hidden">
                <a href="{{ route('landing') }}" class="block px-4 py-2.5 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium whitespace-nowrap transition-colors">
                   ← Kembali ke Landing
                </a>
                
                <div class="border-t my-4 border-gray-100"></div>

                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-700 text-gray-600 font-medium whitespace-nowrap transition-colors">
                   📋 Laporan Masuk
                </a>

                <a href="{{ route('admin.locations.index') }}" class="block px-4 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-700 text-gray-600 font-medium whitespace-nowrap transition-colors">
                   📍 Manajemen Lokasi
                </a>

                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-700 text-gray-600 font-medium whitespace-nowrap transition-colors">
                   🏷️ Manajemen Kategori
                </a>

                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2.5 rounded-xl hover:bg-red-50 hover:text-red-700 text-gray-600 font-medium whitespace-nowrap transition-colors">
                   👥 Manajemen User
                </a>
            </nav>

            <div class="p-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full bg-red-600 text-white py-2.5 rounded-xl font-bold text-sm hover:bg-red-700 transition shadow-sm whitespace-nowrap">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-8 relative z-10 bg-gray-50">
            @yield('content')
        </main>

    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const toggleIcon = document.getElementById('toggleIcon');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-ml-64');
        
        if (sidebar.classList.contains('-ml-64')) {
            toggleIcon.classList.add('rotate-180');
            sidebarToggle.classList.add('translate-x-8', 'bg-red-600', 'text-white', 'border-red-600', 'shadow-lg');
            sidebarToggle.classList.remove('bg-white', 'text-gray-400', 'hover:text-red-600', 'shadow-sm');
        } else {
            toggleIcon.classList.remove('rotate-180');
            sidebarToggle.classList.remove('translate-x-8', 'bg-red-600', 'text-white', 'border-red-600', 'shadow-lg');
            sidebarToggle.classList.add('bg-white', 'text-gray-400', 'hover:text-red-600', 'shadow-sm');
        }
    });
</script>

</body>
</html>