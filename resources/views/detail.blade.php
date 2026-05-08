<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #000; }
    </style>
</head>
<body class="p-6 md:p-12 text-gray-800">
    
    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <a href="/#beranda" class="inline-block bg-white hover:bg-gray-200 transition-colors px-6 py-3 rounded-xl shadow-lg font-semibold text-lg text-black decoration-none">
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <div class="lg:col-span-2 bg-white rounded-xl shadow-2xl p-6 md:p-8">
                <h2 class="text-2xl font-bold mb-6 mt-0">AC di kelas ga dingin</h2>

                <div class="bg-[#EDE9E6] p-4 rounded-lg mb-6">
                    <p class="font-semibold text-gray-800 m-0">Deskripsi Kerusakan:</p>
                </div>

                <h3 class="font-bold text-lg mb-3">Foto Laporan</h3>
                <img src="https://i.pinimg.com/736x/a7/9f/f1/a79ff10ace0ff5427d81f36707403add.jpg" alt="Foto Laporan" class="w-full max-w-md h-48 md:h-64 object-cover rounded-lg mb-6">

                <div class="bg-[#EDE9E6] h-48 rounded-lg w-full max-w-xs">
                    </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-2xl p-6 h-48">
                    <h3 class="font-bold mb-2">Informasi</h3>
                </div>

                <div class="bg-white rounded-xl shadow-2xl p-6 h-32">
                    <h3 class="font-bold mb-2">Status</h3>
                </div>
            </div>

        </div>
    </div>

</body>
</html>