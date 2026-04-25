<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar — SMK Telkom LaporFasilitas</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#B91C1C',
          accent:  '#EF4444',
        },
        fontFamily: {
          sans:    ['Plus Jakarta Sans', 'sans-serif'],
          heading: ['Syne', 'sans-serif'],
        }
      }
    }
  }
</script>
<style>
  * { font-family: 'Plus Jakarta Sans', sans-serif; }

  body {
    background: #fafafa;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
  }

  /* ── Decorative blobs ── */
  .blob-1 {
    position: fixed;
    width: 420px; height: 480px;
    background: #B91C1C;
    border-radius: 60% 40% 55% 45% / 50% 60% 40% 55%;
    top: -80px; right: -60px;
    opacity: 0.92;
    z-index: 0;
  }
  .blob-2 {
    position: fixed;
    width: 380px; height: 420px;
    background: #EF4444;
    border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%;
    top: 60px; right: 80px;
    opacity: 0.5;
    z-index: 0;
  }
  .blob-3 {
    position: fixed;
    width: 220px; height: 260px;
    background: transparent;
    border: 2px solid #FBBF24;
    border-radius: 50% 40% 60% 45% / 45% 60% 40% 55%;
    bottom: 80px; right: 160px;
    z-index: 0;
  }
  .blob-4 {
    position: fixed;
    width: 300px; height: 300px;
    background: rgba(185,28,28,0.08);
    border-radius: 50%;
    bottom: -80px; left: -60px;
    z-index: 0;
  }

  @keyframes morph1 {
    0%,100% { border-radius: 60% 40% 55% 45% / 50% 60% 40% 55%; }
    50%      { border-radius: 40% 60% 45% 55% / 60% 40% 55% 45%; }
  }
  @keyframes morph2 {
    0%,100% { border-radius: 45% 55% 40% 60% / 55% 45% 60% 40%; }
    50%      { border-radius: 55% 45% 60% 40% / 45% 55% 40% 60%; }
  }
  @keyframes morph3 {
    0%,100% { border-radius: 50% 40% 60% 45% / 45% 60% 40% 55%; transform: rotate(0deg); }
    50%      { border-radius: 40% 60% 45% 55% / 60% 40% 55% 45%; transform: rotate(15deg); }
  }

  /* ── Card ── */
  .card {
    position: relative;
    z-index: 10;
    background: #fff;
    border-radius: 24px;
    padding: 44px 40px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 24px 80px rgba(185,28,28,0.12), 0 4px 24px rgba(0,0,0,0.06);
    animation: slideUp 0.6s cubic-bezier(.16,1,.3,1) forwards;
    opacity: 0;
  }
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(32px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ── Logo ring ── */
  .logo-ring {
    width: 52px; height: 52px;
    border-radius: 50%;
    border: 3px solid #B91C1C;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    background: #fff;
    position: relative;
  }
  .logo-ring::after {
    content: '';
    position: absolute;
    width: 36px; height: 36px;
    background: #EF4444;
    border-radius: 50%;
    opacity: 0.15;
  }
  .logo-ring svg { position: relative; z-index: 1; }

  /* ── Input ── */
  .input-wrap { position: relative; margin-bottom: 16px; }
  .input-wrap svg {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    width: 18px; height: 18px; color: #9CA3AF; pointer-events: none; transition: color 0.2s;
  }
  .input-wrap input {
    width: 100%; padding: 13px 14px 13px 42px; border: 1.5px solid #E5E7EB; border-radius: 12px;
    font-size: 0.875rem; color: #111; background: #FAFAFA; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .input-wrap input::placeholder { color: #9CA3AF; }
  .input-wrap input:focus { border-color: #B91C1C; background: #fff; box-shadow: 0 0 0 3px rgba(185,28,28,0.08); }
  .input-wrap input:focus + svg, .input-wrap:focus-within svg { color: #B91C1C; }

  .input-group { position: relative; margin-bottom: 16px; }
  .input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    width: 18px; height: 18px; color: #9CA3AF; pointer-events: none; transition: color 0.2s; z-index: 2;
  }
  .field-input {
    width: 100%; padding: 13px 14px 13px 42px; border: 1.5px solid #E5E7EB; border-radius: 12px;
    font-size: 0.875rem; color: #111; background: #FAFAFA; outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .field-input::placeholder { color: #9CA3AF; }
  .field-input:focus { border-color: #B91C1C; background: #fff; box-shadow: 0 0 0 3px rgba(185,28,28,0.08); }
  .input-group:focus-within .input-icon { color: #B91C1C; }

  /* ── Button ── */
  .btn-red {
    width: 100%; padding: 14px; background: linear-gradient(135deg, #B91C1C 0%, #EF4444 100%);
    color: #fff; font-weight: 700; font-size: 0.9rem; border: none; border-radius: 12px;
    cursor: pointer; letter-spacing: 0.02em; transition: all 0.25s ease;
    box-shadow: 0 4px 16px rgba(185,28,28,0.35);
  }
  .btn-red:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(185,28,28,0.45); }
  .btn-red:active { transform: translateY(0); }

  .divider {
    display: flex; align-items: center; gap: 12px; color: #D1D5DB; font-size: 0.75rem; margin: 20px 0;
  }
  .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #E5E7EB; }

  .link-red { color: #B91C1C; font-weight: 600; font-size: 0.875rem; text-decoration: none; transition: color 0.2s; }
  .link-red:hover { color: #EF4444; }
</style>
</head>
<body>

<div class="blob-1"></div>
<div class="blob-2"></div>
<div class="blob-3"></div>
<div class="blob-4"></div>

<div class="card">

  <div class="logo-ring">
    <svg width="22" height="22" viewBox="0 0 20 20" fill="#B91C1C">
      <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
    </svg>
  </div>

  <h1 class="text-center font-heading font-bold text-2xl mb-1" style="color:#111;font-family:'Syne',sans-serif">Daftar Akun</h1>
  <p class="text-center text-xs text-gray-400 mb-7">Daftar akun portal fasilitas SMK Telkom</p>

  @if($errors->any())
      <div class="mb-4 p-3 bg-red-50 border border-red-100 text-red-600 rounded-xl text-xs">
          <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="input-group">
      <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
      </svg>
      <input type="text" name="name" value="{{ old('name') }}" class="field-input" placeholder="Masukkan Nama Lengkap" required>
    </div>

    <div class="input-group">
      <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
      </svg>
      <input type="email" name="email" value="{{ old('email') }}" class="field-input" placeholder="Masukkan Email" maxlength="50" required>
    </div>

    <div class="input-group">
      <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
      </svg>
      <input type="password" name="password" class="field-input" placeholder="Buat password minimal 8 karakter" required>
    </div>

    <div class="input-group">
      <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
      </svg>
      <input type="password" name="password_confirmation" class="field-input" placeholder="Konfirmasi password" required>
    </div>

    <button type="submit" class="btn-red mt-2">Daftar Sekarang</button>

    <div class="divider">atau</div>
  </form>
    
  <p class="text-center text-sm text-gray-500">
    Sudah punya akun? <a href="{{ route('login') }}" class="link-red">Login</a>
  </p>

  <p class="text-center text-sm text-gray-500 mt-1">
    Kembali ke <a href="{{ route('landing') }}" class="link-red">Halaman</a>
  </p>
</div>

</body>
</html>