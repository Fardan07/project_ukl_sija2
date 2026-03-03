<!DOCTYPE html>
<html>
<head>
    <title>FacSchool Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="hero-bg min-h-screen">

    {{-- NAVBAR --}}
    <nav class="hero-bg sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-white font-bold text-lg">FacSchool Report</h1>

            <div class="flex items-center gap-4">
                <span class="text-white text-sm">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-primary px-4 py-2 rounded-full text-sm">
                        Logout
                    </button>
<p class="text-center text-sm text-gray-500">
      Kembali ke <a href="{{ route('landing') }}" class="link-red">Halaman</a>
    </p>

                </form>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-10">
        @yield('content')
    </div>

</body>
</html>