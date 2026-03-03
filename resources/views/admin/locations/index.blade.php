<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>CRUD Lokasi — Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="p-8 bg-gray-100">

<div class="max-w-5xl mx-auto">

<h1 class="text-2xl font-bold mb-6 text-gray-800">
Manajemen Lokasi
</h1>

{{-- ALERT --}}
@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
{{ session('success') }}
</div>
@endif

{{-- FORM TAMBAH --}}
<div class="bg-white p-6 rounded-xl border mb-8">
<h2 class="font-semibold mb-4">Tambah Lokasi</h2>

<form action="{{ route('admin.locations.store') }}" method="POST">
@csrf

<div class="grid grid-cols-2 gap-4">
<div>
<label class="text-sm block mb-1">Nama Lokasi</label>
<input type="text" name="nama_lokasi"
class="w-full border rounded p-2" required>
</div>

<div>
<label class="text-sm block mb-1">Keterangan</label>
<input type="text" name="keterangan"
class="w-full border rounded p-2">
</div>
</div>

<button class="mt-4 bg-red-700 text-white px-4 py-2 rounded">
Simpan
</button>
</form>
</div>

{{-- TABLE --}}
<div class="bg-white rounded-xl border overflow-hidden">
<table class="w-full">
<thead class="bg-gray-50 text-xs uppercase text-gray-500">
<tr>
<th class="p-3 text-left">#</th>
<th class="p-3 text-left">Nama Lokasi</th>
<th class="p-3 text-left">Keterangan</th>
<th class="p-3 text-left">Action</th>
</tr>
</thead>

<tbody>
@forelse($locations as $location)
<tr class="border-t text-sm">
<td class="p-3">{{ $loop->iteration }}</td>

{{-- EDIT FORM INLINE --}}
<form action="{{ route('admin.locations.update',$location->id) }}" method="POST">
@csrf
@method('PUT')

<td class="p-3">
<input type="text" name="nama_lokasi"
value="{{ $location->nama_lokasi }}"
class="border rounded p-1 w-full">
</td>

<td class="p-3">
<input type="text" name="keterangan"
value="{{ $location->keterangan }}"
class="border rounded p-1 w-full">
</td>

<td class="p-3 flex gap-2">

<button class="text-blue-600 text-sm">
Update
</button>
</form>

<form action="{{ route('admin.locations.destroy',$location->id) }}"
method="POST"
onsubmit="return confirm('Yakin hapus?')">
@csrf
@method('DELETE')
<button class="text-red-600 text-sm">
Hapus
</button>
</form>

</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center p-6 text-gray-400">
Belum ada lokasi.
</td>
</tr>
@endforelse
</tbody>
</table>
</div>

</div>
</body>
</html>