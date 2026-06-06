<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="text-sm text-gray-500 mb-6">
            Beranda / Laporan / Detail Laporan
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">
                        Lampu Kelas 10 Mati
                    </h1>

                    <span class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded-lg text-sm font-medium">
                        DIPROSES
                    </span>
                </div>

                <div class="border border-gray-200 rounded-xl p-5 mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">
                        Deskripsi
                    </h3>

                    <p class="text-gray-600">
                        Lampu di kelas 10 mati sejak kemarin pagi dan tidak pernah menyala lagi. Mohon segera diperbaiki.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <h3 class="font-semibold text-gray-800 mb-3">
                            Foto Laporan
                        </h3>

                        <div class="relative rounded-xl overflow-hidden border border-gray-200">
                            <img
                                src="https://images.unsplash.com/photo-1581092160562-40aa08e78837"
                                alt=""
                                class="w-full h-72 object-cover">

                            <button class="absolute top-3 right-3 bg-white p-2 rounded-lg shadow">
                                🔍
                            </button>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-xl p-4">
                        <h3 class="font-semibold text-gray-800 mb-4">
                            Informasi Laporan
                        </h3>

                        <div class="space-y-4 text-sm">
                            <div>
                                <p class="text-gray-400">Lokasi</p>
                                <p class="font-medium">Kelas 10</p>
                            </div>

                            <div>
                                <p class="text-gray-400">Tgl Laporan</p>
                                <p class="font-medium">12 April 2026</p>
                            </div>

                            <div>
                                <p class="text-gray-400">Pelapor</p>
                                <p class="font-medium">Andi</p>
                            </div>

                            <div>
                                <p class="text-gray-400">Kategori</p>
                                <p class="font-medium">Listrik</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <a href="#" class="px-5 py-2 border rounded-lg text-gray-600 hover:bg-gray-50">
                        Kembali
                    </a>

                    <a href="#" class="px-5 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                        Edit Laporan
                    </a>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-xl font-semibold mb-5">
                        Informasi Laporan
                    </h3>

                    <div class="space-y-5">
                        <div>
                            <p class="text-gray-400 text-sm">Lokasi</p>
                            <p class="font-medium">Kelas 10</p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-sm">Tgl Laporan</p>
                            <p class="font-medium">12 April 2026</p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-sm">Pelapor</p>
                            <p class="font-medium">Andi</p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-sm">Kategori</p>
                            <p class="font-medium">Listrik</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-xl font-semibold mb-5">
                        Riwayat Status
                    </h3>

                    <div class="space-y-4">
                        <div class="flex gap-3">
                            <div class="w-5 h-5 rounded-full bg-green-500 mt-1"></div>
                            <p class="text-sm text-gray-700">
                                12 Apr 2026 - Diterima
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="w-5 h-5 rounded-full bg-yellow-400 mt-1"></div>
                            <p class="text-sm text-gray-700">
                                12 Apr 2026 - Sedang diproses oleh admin
                            </p>
                        </div>

                        <div class="flex gap-3">
                            <div class="w-5 h-5 rounded-full bg-orange-400 mt-1"></div>
                            <p class="text-sm text-gray-700">
                                13 Apr 2026 - Sedang diperbaiki oleh petugas
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>