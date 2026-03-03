<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
* { font-family: 'Plus Jakarta Sans', sans-serif; }
</style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">

        <div class="p-6 border-b">
            <h2 class="text-lg font-bold text-gray-800">Admin Panel</h2>
            <p class="text-xs text-gray-400">SMK Telkom</p>
        </div>

        <nav class="flex-1 p-4 space-y-2 text-sm">

    <!-- Tombol Kembali -->
    <a href="{{ route('landing') }}"
       class="block px-4 py-2 rounded-lg bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium">
       ← Kembali ke Landing
    </a>

    <div class="border-t my-3"></div>

    <a href="{{ route('admin.dashboard') }}"
       class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
       📋 Laporan
    </a>

    <a href="{{ route('admin.locations.index') }}"
       class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
       📍 Lokasi
    </a>

    <a href="#"
       class="block px-4 py-2 rounded-lg hover:bg-gray-100 text-gray-700">
       🏷️ Kategori
    </a>

</nav>

        <div class="p-4 border-t">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-600 text-white py-2 rounded-lg text-sm hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>