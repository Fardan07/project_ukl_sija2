<!-- User Dashboard -->
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Laporan Saya</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { font-family: 'Plus Jakarta Sans', sans-serif; }

  table { width: 100%; border-collapse: collapse; }
  thead th {
    background: #f9fafb;
    padding: 11px 14px;
    text-align: left;
    font-size: 0.75rem;
    font-weight: 700;
    color: #6B7280;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid #E5E7EB;
  }
  tbody tr { border-bottom: 1px solid #F3F4F6; transition: background 0.1s; }
  tbody tr:last-child { border-bottom: none; }
  tbody tr:hover { background: #fafafa; }
  tbody td { padding: 12px 14px; font-size: 0.875rem; color: #374151; vertical-align: middle; }

  .badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: capitalize;
  }
  .badge-baru    { background: #FEF9C3; color: #854D0E; }
  .badge-proses  { background: #DBEAFE; color: #1D4ED8; }
  .badge-selesai { background: #DCFCE7; color: #15803D; }

  nav[aria-label="Pagination"] { display: flex; align-items: center; gap: 4px; }
  nav[aria-label="Pagination"] span,
  nav[aria-label="Pagination"] a {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 32px; height: 32px; padding: 0 6px;
    border-radius: 6px; font-size: 0.8rem; font-weight: 600;
    border: 1px solid #E5E7EB; background: #fff; color: #374151;
    text-decoration: none; transition: all 0.15s;
  }
  nav[aria-label="Pagination"] a:hover { border-color: #B91C1C; color: #B91C1C; }
  nav[aria-label="Pagination"] span[aria-current="page"] {
    background: #B91C1C; color: #fff; border-color: #B91C1C;
  }
  nav[aria-label="Pagination"] span.disabled { opacity: 0.4; cursor: not-allowed; }
</style>
</head>

<body class="p-8" style="background:#f5f5f5">

<div class="max-w-4xl mx-auto">

  <!-- Header -->
  <div class="flex items-center justify-between mb-6">

  
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Data Laporan Saya</h1>
      <p class="text-sm text-gray-400 mt-0.5">Riwayat laporan yang telah kamu kirim</p>
    </div>

    <a href="{{ route('landing') }}"
       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-white border border-gray-200 text-gray-600 text-sm font-medium hover:bg-gray-50 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      Kembali
    </a>
  </div>

  <!-- Table card -->
  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

    <div class="overflow-x-auto">
      <table>
        <thead>
          <tr>
            <th style="width:44px">#</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Tanggal</th>
          </tr>
        </thead>

        <tbody>
          @forelse($reports as $report)
          <tr>
            <td class="text-gray-400 text-xs font-medium">{{ $loop->iteration }}</td>
            <td class="font-medium text-gray-800">{{ $report->facility->nama_fasilitas }}</td>
            <td class="text-gray-500">{{ $report->location->nama_lokasi }}</td>
            <td>
              @php
                $statusClass = match($report->status) {
                  'proses'  => 'badge-proses',
                  'selesai' => 'badge-selesai',
                  default   => 'badge-baru',
                };
              @endphp
              <span class="badge {{ $statusClass }}">{{ $report->status }}</span>
            </td>
            <td class="text-xs text-gray-400 whitespace-nowrap">{{ $report->created_at->format('d M Y') }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center py-12 text-sm text-gray-400">
              <svg class="w-10 h-10 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
              Belum ada laporan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 border-t border-gray-100">
      {{ $reports->links() }}
    </div>

  </div>
</div>

</body>
</html>