<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FacSchool Report — SMK Telkom</title>
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
  .hero-bg::before {
    content: '';
    position: absolute;
    width: 520px; height: 520px;
    background: rgba(239,68,68,0.15);
    border-radius: 50%;
    top: -120px; right: -80px;
  }
  .hero-bg::after {
    content: '';
    position: absolute;
    width: 280px; height: 280px;
    background: rgba(239,68,68,0.1);
    border-radius: 50%;
    bottom: -60px; left: 180px;
  }

  .card-hover { transition: all 0.3s ease; }
  .card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(185,28,28,0.15);
  }

  .btn-primary {
    background: #EF4444;
    color: #fff;
    font-weight: 700;
    transition: all 0.3s ease;
  }
  .btn-primary:hover {
    background: #DC2626;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(239,68,68,0.45);
  }

  .btn-outline {
    border: 2px solid rgba(255,255,255,0.4);
    color: white;
    transition: all 0.3s ease;
  }
  .btn-outline:hover { background: rgba(255,255,255,0.12); }

  .dot-pattern {
    background-image: radial-gradient(circle, #EF4444 1px, transparent 1px);
    background-size: 22px 22px;
    opacity: 0.2;
  }

  .section-label {
    color: #EF4444;
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    display: block;
  }

  .nav-link { color: rgba(255,255,255,0.75); transition: color 0.2s; text-decoration: none; }
  .nav-link:hover { color: #fca5a5; }

  .badge {
    background: rgba(239,68,68,0.12);
    color: #EF4444;
    border: 1px solid rgba(239,68,68,0.25);
  }

  .status-open   { background: #FEF9C3; color: #854D0E; }
  .status-progress { background: #DBEAFE; color: #1E40AF; }
  .status-done   { background: #DCFCE7; color: #166534; }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .afu  { animation: fadeUp 0.7s ease forwards; }
  .d1   { animation-delay: 0.1s; opacity: 0; }
  .d2   { animation-delay: 0.25s; opacity: 0; }
  .d3   { animation-delay: 0.4s; opacity: 0; }
  .d4   { animation-delay: 0.55s; opacity: 0; }

  .red-blob { background: radial-gradient(ellipse, rgba(239,68,68,0.18) 0%, transparent 70%); }

  details summary::-webkit-details-marker { display: none; }
  details summary { list-style: none; }
</style>
</head>
<body class="bg-white overflow-x-hidden" style="color:#1C0A0A">

<!-- NAVBAR -->
<header class="relative z-[9999]">
<nav class="hero-bg sticky top-0 shadow-lg relative z-[9999]">
  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    <div class="flex items-center gap-3">
      <div class="w-9 h-9 bg-white rounded-xl flex items-center justify-center shadow">
        <svg class="w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
        </svg>
      </div>
      <div>
        <p class="font-heading text-white text-base font-bold leading-none">FacSchool Report</p>
        <p class="text-[10px] leading-none mt-0.5" style="color:rgba(255,255,255,0.5)">Portal Lapor Fasilitas</p>
      </div>
    </div>

    <div class="hidden md:flex items-center gap-8">
      <a href="#beranda"  class="nav-link text-sm font-medium">Beranda</a>
      <a href="#tentang"  class="nav-link text-sm font-medium">Tentang</a>
      <a href="#kategori" class="nav-link text-sm font-medium">Kategori</a>
      <a href="#laporan"  class="nav-link text-sm font-medium">Laporan</a>
      <a href="#faq"      class="nav-link text-sm font-medium">FAQ</a>
    </div>

    <div class="flex items-center gap-4 relative z-[9999]">

    @auth
        <span class="text-white text-sm">
            Halo, {{ auth()->user()->name }}
        </span>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="bg-white text-red-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
               Dashboard
            </a>
        @else
            <a href="{{ route('dashboard') }}"
               class="bg-white text-red-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
               Dashboard
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit"
                class="bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-800 transition">
                Logout
            </button>
        </form>

    @else
    <a href="{{ route('login') }}"
       class="bg-white text-red-700 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
       Login
    </a>
@endauth

    </div>

  </div>
</nav>
</header>

<!-- HERO -->
<section id="beranda" class="hero-bg flex items-center relative" style="min-height:88vh">
  <div class="absolute inset-0 dot-pattern pointer-events-none"></div>
  <div class="max-w-7xl mx-auto px-6 py-20 w-full grid gap-14 items-center relative z-10" style="grid-template-columns:1fr 1fr">
    <div>
      <div class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 mb-6 afu d1" style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2)">
        <div class="w-2 h-2 bg-red-300 rounded-full" style="animation:pulse 2s infinite"></div>
        <span class="text-xs font-medium" style="color:rgba(255,255,255,0.8)">Portal Resmi SMK Telkom</span>
      </div>
      <h1 class="font-heading text-white font-bold leading-tight mb-6 afu d2" style="font-size:clamp(2.5rem,5vw,3.75rem)">
        Lapor Kerusakan<br/>
        Fasilitas <span style="color:#fca5a5">SMK Telkom</span><br/>
        Lebih Mudah
      </h1>
      <p class="text-lg mb-8 max-w-lg afu d3" style="color:rgba(255,255,255,0.7)">
        Temukan kerusakan di ruang kelas, lab, toilet, atau area sekolah? Laporkan sekarang dan pantau progres perbaikannya secara real-time.
      </p>
      <div class="flex flex-wrap gap-4 afu d4">
        <a href="#form-laporan" class="btn-primary px-7 py-3 rounded-full text-base inline-flex items-center gap-2">
          Buat Laporan
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        <a href="{{ route('laporan.lialapo') }}" class="btn-outline px-7 py-3 rounded-full text-base">Lihat Laporan</a>
      </div>
      <div class="flex flex-wrap gap-4 mt-10 afu d4">
          
          </div>
        </div>
      </div>
    </div>
</section>

<!-- TENTANG -->
<section id="tentang" class="py-24 bg-white">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
    <div class="grid grid-cols-2 gap-4">
      <div class="rounded-3xl p-6 flex flex-col justify-between" style="background:#FEF2F2;aspect-ratio:1">
        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center">
          <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
          <p class="font-heading text-3xl font-bold text-red-800">Ada Kerusakan Fasilitas?</p>
          <p class="text-sm text-gray-500 mt-1">Segera Lapor!</p>
        </div>
      </div>
      <div class="col-span-2 rounded-3xl p-6 flex items-center gap-4" style="background:#FFF5F5;border:1px solid #FECACA">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center flex-shrink-0" style="background:#B91C1C">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div>
          <p class="font-heading text-xl font-bold text-red-800">Respons Cepat</p>
          <p class="text-sm text-gray-500">Tim teknis SMK Telkom merespons setiap laporan dalam 48 jam kerja</p>
        </div>
      </div>
    </div>
    <div>
      <span class="section-label mb-3">Tentang Platform</span>
      <h2 class="font-heading text-4xl font-bold leading-tight mb-6" style="color:#B91C1C">
        Jalan Menuju Sekolah<br/>yang Lebih Terawat
      </h2>
      <p class="text-gray-600 leading-relaxed mb-4">
        Portal ini dibuat khusus untuk warga SMK Telkom — siswa, guru, dan staf — agar bisa melaporkan kerusakan atau masalah fasilitas sekolah dengan cepat dan mudah langsung dari genggaman tangan.
      </p>
      <p class="text-gray-600 leading-relaxed mb-8">
        Setiap laporan yang masuk akan langsung diteruskan ke tim sarana-prasarana sekolah dan dapat dipantau statusnya secara real-time hingga selesai diperbaiki.
      </p>
      <a href="#form-laporan" class="btn-primary px-7 py-3 rounded-full text-sm inline-flex items-center gap-2">
        Mulai Lapor Sekarang
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<!-- KATEGORI -->
<section id="kategori" class="py-24 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
    <div class="text-center mb-14">
      <span class="section-label mb-3">Kategori Laporan</span>
      <h2 class="font-heading text-4xl font-bold" style="color:#B91C1C">Jenis Fasilitas<br/>yang Bisa Dilaporkan</h2>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white rounded-3xl p-6 card-hover border border-gray-100 shadow-sm">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5" style="background:#FEF2F2">
          <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 00-1-1h-2a1 1 0 00-1 1v5m4 0H9"/></svg>
        </div>
        <h3 class="font-heading text-lg font-bold text-red-800 mb-2">Ruang Kelas</h3>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">Atap bocor, dinding retak, pintu/jendela rusak, papan tulis, dan kondisi lantai kelas.</p>
        <button class="w-8 h-8 rounded-full flex items-center justify-center transition-all" style="background:#FEF2F2">
          <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="bg-white rounded-3xl p-6 card-hover border border-gray-100 shadow-sm">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5" style="background:#FEF2F2">
          <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h3 class="font-heading text-lg font-bold text-red-800 mb-2">Lab & Teknologi</h3>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">Komputer rusak, proyektor mati, internet lambat, peralatan lab tidak berfungsi, dan AC.</p>
        <button class="w-8 h-8 rounded-full flex items-center justify-center transition-all" style="background:#FEF2F2">
          <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="bg-white rounded-3xl p-6 card-hover border border-gray-100 shadow-sm">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5" style="background:#FEF2F2">
          <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h3 class="font-heading text-lg font-bold text-red-800 mb-2">Listrik & Air</h3>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">Lampu mati, stop kontak rusak, kebocoran pipa, keran tidak berfungsi, dan sanitasi toilet.</p>
        <button class="w-8 h-8 rounded-full flex items-center justify-center transition-all" style="background:#FEF2F2">
          <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="bg-white rounded-3xl p-6 card-hover border border-gray-100 shadow-sm">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-5" style="background:#FEF2F2">
          <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
        </div>
        <h3 class="font-heading text-lg font-bold text-red-800 mb-2">Perabot & Lainnya</h3>
        <p class="text-gray-500 text-sm leading-relaxed mb-4">Meja & kursi rusak, loker, rak perpustakaan, kantin, lapangan olahraga, dan area parkir.</p>
        <button class="w-8 h-8 rounded-full flex items-center justify-center transition-all" style="background:#FEF2F2">
          <svg class="w-4 h-4 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- FORM LAPORAN -->
<section id="form-laporan" class="py-24 hero-bg relative overflow-hidden">
  <div class="absolute inset-0 dot-pattern"></div>
  <div class="absolute top-0 right-0 w-96 h-96 red-blob pointer-events-none"></div>
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center relative z-10">
    <div>
      <span class="section-label mb-3" style="color:#fca5a5">Formulir Laporan</span>
      <h2 class="font-heading text-4xl font-bold text-white leading-tight mb-6">
        Laporkan Masalah<br/>
        <span style="color:#fca5a5">Fasilitas Sekolah</span><br/>
        Sekarang
      </h2>
      <p class="leading-relaxed mb-6" style="color:rgba(255,255,255,0.7)">
        Isi formulir di samping dengan lengkap agar tim sarana-prasarana SMK Telkom bisa menindaklanjuti laporanmu secepat mungkin.
      </p>
      <div class="space-y-3">
        <div class="flex items-center gap-3">
          <div class="w-6 h-6 bg-red-400 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </div>
          <span class="text-sm" style="color:rgba(255,255,255,0.8)">Menjaga Fasilitas Sekolah</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-6 h-6 bg-red-400 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </div>
          <span class="text-sm" style="color:rgba(255,255,255,0.8)">Upload foto bukti kerusakan</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-6 h-6 bg-red-400 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </div>
          <span class="text-sm" style="color:rgba(255,255,255,0.8)">Bisa dilaporkan secara anonim</span>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-6 h-6 bg-red-400 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          </div>
          <span class="text-sm" style="color:rgba(255,255,255,0.8)">Lacak progres perbaikan real-time</span>
        </div>
      </div>
    </div>
    <!-- Form white card -->
    <div class="bg-white rounded-3xl shadow-2xl p-8">
  <h3 class="font-heading text-2xl font-bold text-red-800 mb-6">
    Form Laporan Fasilitas
  </h3>

  <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="space-y-4">

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600">
          Nama Pelapor
        </label>
        <input type="text"
               value="{{ optional(auth()->user())->name }}"
               readonly
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm bg-gray-100">
      </div>

      <div>
        <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600" required>
          Kelas / Jabatan
        </label>
        <input type="text"
               name="kelas_jabatan"
               placeholder="cth: XII TJAT 1 / Guru"
               class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">
      </div>
    </div>

    <!-- KATEGORI (tetap ada seperti desain kamu) -->
    <div>
      <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600" required>
        Kategori Fasilitas
      </label>
@error('facility_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
      <select name="facility_id"
              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 focus:outline-none">
        <option value="">Pilih kategori...</option>

        @forelse($facilities as $facility)
          <option value="{{ $facility->id }}">
            {{ $facility->nama_fasilitas }}
          </option>
        @empty
          <option value="">Belum ada data fasilitas</option>
        @endforelse

      </select>
    </div>

    <!-- LOKASI -->
    <div>
      <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600" required>
        Lokasi Spesifik
      </label>
@error('location_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
      <select name="location_id"
              class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none">

        <option value="">Pilih lokasi...</option>

        @forelse($locations as $location)
          <option value="{{ $location->id }}">
            {{ $location->nama_lokasi }}
          </option>
        @empty
          <option value="">Belum ada data lokasi</option>
        @endforelse

      </select>
    </div>

    <!-- DESKRIPSI -->
    <div>
      <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600">
        Deskripsi Kerusakan
      </label>
@error('deskripsi')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
@enderror
      <textarea name="deskripsi"
                rows="3"
                placeholder="Jelaskan kerusakan yang kamu temukan secara detail..."
                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none resize-none"></textarea>
    </div>

    <!-- URGENSI -->
    <div>
      <label class="text-xs font-semibold mb-1.5 block uppercase tracking-wide text-gray-600">
        Tingkat Urgensi
      </label>

      <div class="flex gap-3">
        <label class="flex-1 flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-red-400 transition-colors">
          <input type="radio" name="urgensi" value="normal" style="accent-color:#B91C1C">
          <span class="text-sm text-gray-600">Normal</span>
        </label>

        <label class="flex-1 flex items-center gap-2 border border-gray-200 rounded-xl px-4 py-3 cursor-pointer hover:border-red-400 transition-colors">
          <input type="radio" name="urgensi" value="darurat" style="accent-color:#B91C1C">
          <span class="text-sm text-gray-600">⚡ Darurat</span>
        </label>
      </div>
    </div>

    <!-- FOTO -->
    <div class="rounded-xl p-4 text-center cursor-pointer hover:border-red-400 transition-colors"
         style="border:2px dashed #e5e7eb">

      <input type="file" name="foto" class="w-full text-sm">

      <p class="text-xs text-gray-400">
        Klik untuk upload foto bukti kerusakan (opsional)
      </p>
    </div>

    <button type="submit"
            class="btn-primary w-full py-3.5 rounded-xl text-sm font-bold tracking-wide">
      🚨 Kirim Laporan Sekarang
    </button>

  </div>
  </form>
</div>
</section>

<!-- CTA BANNER -->
<section class="py-24 hero-bg relative overflow-hidden">
  <div class="absolute inset-0 dot-pattern"></div>
  <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
    <span class="section-label mb-4" style="color:#fca5a5">Ayo Bergerak</span>
    <h2 class="font-heading text-5xl font-bold text-white mb-6">
      Temukan Kerusakan?<br/>
      <span style="color:#fca5a5">Langsung Lapor!</span>
    </h2>
    <p class="text-lg mb-10 max-w-xl mx-auto" style="color:rgba(255,255,255,0.7)">
      Jangan diam. Setiap laporan dari kamu membantu menjaga kenyamanan belajar seluruh warga SMK Telkom.
    </p>
    <div class="flex flex-wrap gap-4 justify-center">
      <a href="#form-laporan" class="btn-primary px-8 py-4 rounded-full text-base font-bold">+ Buat Laporan Sekarang</a>
      <a href="#laporan" class="btn-outline px-8 py-4 rounded-full text-base font-medium">Pantau Status Laporan</a>
    </div>
  </div>
</section>



<!-- FAQ -->
<section id="faq" class="py-24 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-start">
    <div>
      <span class="section-label mb-3">FAQ</span>
      <h2 class="font-heading text-4xl font-bold mb-4" style="color:#B91C1C">Pertanyaan<br/>Umum</h2>
      <p class="text-gray-500 mb-8 text-sm leading-relaxed">Punya pertanyaan lain? Hubungi bagian Sarana & Prasarana SMK Telkom langsung.</p>
      <div class="bg-white rounded-3xl p-6 flex items-center gap-4 shadow-sm">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center flex-shrink-0" style="background:#FEF2F2">
          <svg class="w-7 h-7 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        </div>
        <div>
          <p class="font-semibold text-sm text-red-800">Hubungi Sarana Prasarana</p>
          <p class="text-gray-400 text-xs">(021) 555-0123 · sarpras@smktelkom.sch.id</p>
        </div>
        <button class="ml-auto btn-primary px-4 py-2 rounded-full text-xs">Hubungi</button>
      </div>
    </div>
    <div class="space-y-3">
      <details class="bg-white rounded-2xl overflow-hidden shadow-sm group">
        <summary class="flex items-center justify-between p-5 cursor-pointer font-semibold text-red-800">
          Siapa yang bisa membuat laporan?
          <svg class="w-5 h-5 text-red-500 flex-shrink-0 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <div class="px-5 pb-5 text-gray-500 text-sm leading-relaxed">
          Semua warga SMK Telkom — siswa, guru, staf TU, maupun karyawan lainnya — bisa membuat laporan. Tersedia juga opsi laporan anonim.
        </div>
      </details>
      <details class="bg-white rounded-2xl overflow-hidden shadow-sm group">
        <summary class="flex items-center justify-between p-5 cursor-pointer font-semibold text-red-800">
          Berapa lama laporan ditindaklanjuti?
          <svg class="w-5 h-5 text-red-500 flex-shrink-0 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <div class="px-5 pb-5 text-gray-500 text-sm leading-relaxed">
          Tim Sarpras akan merespons dalam 48 jam kerja. Untuk laporan darurat (korsleting, kebocoran besar), tersedia jalur prioritas dengan respons dalam 4 jam.
        </div>
      </details>
      <details class="bg-white rounded-2xl overflow-hidden shadow-sm group">
        <summary class="flex items-center justify-between p-5 cursor-pointer font-semibold text-red-800">
          Bagaimana cara melacak status laporan saya?
          <svg class="w-5 h-5 text-red-500 flex-shrink-0 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <div class="px-5 pb-5 text-gray-500 text-sm leading-relaxed">
          Setelah mengirim laporan, kamu akan mendapat nomor tiket. Masukkan nomor tiket di halaman "Pantau Status" untuk melihat perkembangan perbaikan.
        </div>
      </details>
      <details class="bg-white rounded-2xl overflow-hidden shadow-sm group">
        <summary class="flex items-center justify-between p-5 cursor-pointer font-semibold text-red-800">
          Apakah laporan saya bisa dilihat orang lain?
          <svg class="w-5 h-5 text-red-500 flex-shrink-0 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </summary>
        <div class="px-5 pb-5 text-gray-500 text-sm leading-relaxed">
          Laporan ditampilkan secara publik (tanpa nama jika anonim) untuk transparansi. Data pribadi hanya dilihat oleh tim Sarpras dan kepala sekolah.
        </div>
      </details>
    </div>
  </div>
</section>

<!-- FOOTER -->
<footer class="py-14" style="background:#1C0A0A">
  <div class="max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-10 mb-10">
      <div class="md:col-span-2">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#B91C1C">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/></svg>
          </div>
          <div>
            <p class="font-heading text-white font-bold leading-none">SMK Telkom</p>
            <p class="text-[10px] mt-0.5" style="color:rgba(255,255,255,0.4)">Portal Lapor Fasilitas</p>
          </div>
        </div>
        <p class="text-sm leading-relaxed max-w-xs" style="color:rgba(255,255,255,0.4)">
          Platform pelaporan fasilitas resmi SMK Telkom. Bersama kita jaga kenyamanan lingkungan belajar.
        </p>
        <p class="text-xs mt-4" style="color:rgba(255,255,255,0.3)">Jl. Telekomunikasi No.1, Bandung, Jawa Barat</p>
      </div>
      <div>
        <p class="text-white font-semibold mb-4 text-sm">Tautan Cepat</p>
        <ul class="space-y-2">
          <li><a href="#beranda" class="text-sm transition-colors" style="color:rgba(255,255,255,0.4)">Beranda</a></li>
          <li><a href="#form-laporan" class="text-sm transition-colors" style="color:rgba(255,255,255,0.4)">Buat Laporan</a></li>
          <li><a href="#laporan" class="text-sm transition-colors" style="color:rgba(255,255,255,0.4)">Status Laporan</a></li>
          <li><a href="#faq" class="text-sm transition-colors" style="color:rgba(255,255,255,0.4)">FAQ</a></li>
        </ul>
      </div>
      <div>
        <p class="text-white font-semibold mb-4 text-sm">Kontak</p>
        <ul class="space-y-2">
          <li><span class="text-sm" style="color:rgba(255,255,255,0.4)">(021) 555-0123</span></li>
          <li><span class="text-sm" style="color:rgba(255,255,255,0.4)">sarpras@smktelkom.sch.id</span></li>
          <li><span class="text-sm" style="color:rgba(255,255,255,0.4)">Senin–Jumat, 07.00–16.00</span></li>
        </ul>
      </div>
    </div>
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-8" style="border-top:1px solid rgba(255,255,255,0.1)">
      <p class="text-xs" style="color:rgba(255,255,255,0.25)">© 2025 SMK Telkom. Hak cipta dilindungi.</p>
      <div class="flex gap-4">
        <a href="#" class="text-xs transition-colors" style="color:rgba(255,255,255,0.25)">Kebijakan Privasi</a>
        <a href="#" class="text-xs transition-colors" style="color:rgba(255,255,255,0.25)">Syarat & Ketentuan</a>
      </div>
    </div>
  </div>
</footer>

</body>
</html>