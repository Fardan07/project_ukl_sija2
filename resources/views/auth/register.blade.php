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
    padding: 24px 0;
  }

  /* ── Blobs ── */
  .blob-1 {
    position: fixed;
    width: 380px; height: 440px;
    background: #B91C1C;
    border-radius: 40% 60% 55% 45% / 50% 40% 60% 55%;
    bottom: -60px; left: -80px;
    opacity: 0.88;
    z-index: 0;
  }
  .blob-2 {
    position: fixed;
    width: 320px; height: 360px;
    background: #EF4444;
    border-radius: 55% 45% 40% 60% / 45% 60% 40% 55%;
    bottom: 80px; left: 60px;
    opacity: 0.45;
    z-index: 0;
  }
  .blob-3 {
    position: fixed;
    width: 200px; height: 240px;
    background: transparent;
    border: 2px solid #FBBF24;
    border-radius: 50% 40% 60% 45% / 45% 60% 40% 55%;
    top: 100px; left: 180px;
    z-index: 0;
  }
  .blob-4 {
    position: fixed;
    width: 260px; height: 260px;
    background: rgba(185,28,28,0.07);
    border-radius: 50%;
    top: -60px; right: -40px;
    z-index: 0;
  }

  @keyframes morph1 {
    0%,100% { border-radius: 40% 60% 55% 45% / 50% 40% 60% 55%; }
    50%      { border-radius: 60% 40% 45% 55% / 40% 60% 50% 45%; }
  }
  @keyframes morph2 {
    0%,100% { border-radius: 55% 45% 40% 60% / 45% 60% 40% 55%; }
    50%      { border-radius: 45% 55% 60% 40% / 60% 40% 55% 45%; }
  }
  @keyframes morph3 {
    0%,100% { border-radius: 50% 40% 60% 45% / 45% 60% 40% 55%; transform: rotate(0deg); }
    50%      { border-radius: 40% 60% 45% 55% / 60% 40% 55% 45%; transform: rotate(-15deg); }
  }

  /* ── Card ── */
  .card {
    position: relative;
    z-index: 10;
    background: #fff;
    border-radius: 24px;
    padding: 40px 40px;
    width: 100%;
    max-width: 440px;
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

  /* ── Input group ── */
  .input-group { position: relative; }
  .input-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    width: 17px; height: 17px;
    color: #9CA3AF;
    pointer-events: none;
    transition: color 0.2s;
    z-index: 2;
  }
  .field-input {
    width: 100%;
    padding: 12px 14px 12px 40px;
    border: 1.5px solid #E5E7EB;
    border-radius: 12px;
    font-size: 0.85rem;
    color: #111;
    background: #FAFAFA;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  }
  .field-input::placeholder { color: #9CA3AF; }
  .field-input:focus {
    border-color: #B91C1C;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(185,28,28,0.08);
  }
  .input-group:focus-within .input-icon { color: #B91C1C; }

  select.field-input { cursor: pointer; color: #9CA3AF; }
  select.field-input.selected { color: #111; }

  /* eye btn */
  .eye-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #9CA3AF;
    display: flex;
    z-index: 2;
    transition: color 0.2s;
  }
  .eye-btn:hover { color: #B91C1C; }

  /* ── Button ── */
  .btn-red {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, #B91C1C 0%, #EF4444 100%);
    color: #fff;
    font-weight: 700;
    font-size: 0.875rem;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    letter-spacing: 0.02em;
    transition: all 0.25s ease;
    box-shadow: 0 4px 16px rgba(185,28,28,0.35);
  }
  .btn-red:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(185,28,28,0.45);
  }
  .btn-red:active { transform: translateY(0); }

  .divider {
    display: flex; align-items: center; gap: 12px;
    color: #D1D5DB; font-size: 0.75rem; margin: 18px 0;
  }
  .divider::before, .divider::after {
    content: ''; flex: 1; height: 1px; background: #E5E7EB;
  }

  .link-red {
    color: #B91C1C;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: color 0.2s;
  }
  .link-red:hover { color: #EF4444; }

</style>
</head>
<body>

<!-- Blobs (mirrored side) -->
<div class="blob-1"></div>
<div class="blob-2"></div>
<div class="blob-3"></div>
<div class="blob-4"></div>

<!-- Card -->
<div class="card">

  <!-- Logo -->
  <div class="logo-ring">
    <svg width="22" height="22" viewBox="0 0 20 20" fill="#B91C1C">
      <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
    </svg>
  </div>

  <!-- Title -->
  <h1 class="text-center font-bold text-2xl mb-1" style="font-family:'Syne',sans-serif;color:#111">Daftar Akun</h1>
  <p class="text-center text-xs text-gray-400 mb-6">Daftar akun portal fasilitas SMK Telkom</p>

  @if ($errors->any())
    <div style="background:#fee2e2;padding:10px;margin-bottom:15px;border-radius:8px;color:#991b1b;font-size:13px;">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

  <!-- Form -->
  <form method="POST" action="{{ route('register') }}" class="space-y-3">
  @csrf

    <!-- Nama Lengkap -->
    <div class="input-group">
      
      <input type="text"
       name="name"
       value="{{ old('name') }}"
       class="field-input"
       placeholder="Masukkan Nama Lengkap"
       maxlength="50"
       required>
    </div>

    <!-- Email -->
    <div class="input-group">
      
      <input type="email"
       name="email"
       value="{{ old('email') }}"
       class="field-input"
       placeholder="Masukkan Email"
       maxlength="50"
       required>
    </div>

        <select name="role" id="roleSelect" class="field-input"required onchange="toggleGuruField()">
    <option value="">Pilih Role</option>
    <option value="siswa">Siswa</option>
    <option value="guru">Guru</option>
    <option value="admin">Admin</option>
</select>

    <!-- Password -->
    <div class="input-group">
     
      <input type="password"
       name="password"
       id="passReg"
       class="field-input"
       placeholder="Buat password minimal 8 karakter"
       style="padding-right:42px"
       required>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        
      </button>
    </div>

<div class="input-group hidden" id="guruField">
    <input type="text"
       name="no_guru"
       id="noGuruInput"
       class="field-input"
       placeholder="Nomor Induk Guru/Admin">
</div>

    <!-- Konfirmasi Password -->
    <div class="input-group">
      <input type="password"
       name="password_confirmation"
       id="passConf"
       class="field-input"
       placeholder="Konfirmasi password"
       style="padding-right:42px"
       required>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        </svg>
      </button>
    </div>

    <button type="submit" class="btn-red">Daftar Sekarang</button>

    <div class="divider">atau</div>
    </form>
    <p class="text-center text-sm text-gray-500">
      Sudah punya akun? <a href="{{ route('login') }}" class="link-red">Login</a>
    </p>

     <p class="text-center text-sm text-gray-500">
      Kembali ke <a href="{{ route('landing') }}" class="link-red">Halaman</a>
    </p>

<script>
function toggleGuruField() {
    const role = document.getElementById('roleSelect').value;
    const guruField = document.getElementById('guruField');

    if (role === 'guru' || role === 'admin') {
        guruField.classList.remove('hidden');
    } else {
        guruField.classList.add('hidden');
    }
}
</script>

  </div>
</div>
</body>
</html>