@extends('layouts.admin')

@section('content')

<style>
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

  .badge { display:inline-block;padding:3px 10px;border-radius:999px;font-size:.72rem;font-weight:600;text-transform:capitalize;}
  .badge-baru{background:#FEF9C3;color:#854D0E;}
  .badge-proses{background:#DBEAFE;color:#1D4ED8;}
  .badge-selesai{background:#DCFCE7;color:#15803D;}

  .btn-action{display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:6px;font-size:.75rem;font-weight:600;cursor:pointer;border:none;background:none;transition:.15s;}
  .btn-proses{background:#EFF6FF;color:#1D4ED8;}
  .btn-proses:hover{background:#DBEAFE;}
  .btn-selesai{background:#F0FDF4;color:#15803D;}
  .btn-selesai:hover{background:#DCFCE7;}
  .btn-hapus{background:#FEF2F2;color:#B91C1C;}
  .btn-hapus:hover{background:#FEE2E2;}

  nav[aria-label="Pagination"]{display:flex;align-items:center;gap:4px;}
  nav[aria-label="Pagination"] span,
  nav[aria-label="Pagination"] a{
    display:inline-flex;align-items:center;justify-content:center;
    min-width:32px;height:32px;padding:0 6px;
    border-radius:6px;font-size:.8rem;font-weight:600;
    border:1px solid #E5E7EB;background:#fff;color:#374151;
    text-decoration:none;transition:.15s;
  }
  nav[aria-label="Pagination"] a:hover{border-color:#B91C1C;color:#B91C1C;}
  nav[aria-label="Pagination"] span[aria-current="page"]{
    background:#B91C1C;color:#fff;border-color:#B91C1C;
  }
</style>

<div class="max-w-6xl mx-auto">

  <div class="flex items-center justify-between mb-6">
    <div>
      <h1 class="text-2xl font-bold text-gray-800">Data Semua Laporan</h1>
      <p class="text-sm text-gray-400 mt-0.5">FacSchool Report — Panel Admin</p>
    </div>
  
  </div>

  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

    <div class="overflow-x-auto">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse($reports as $report)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $report->user->name }}</td>
            <td>{{ $report->facility->nama_fasilitas }}</td>
            <td>{{ $report->location->nama_lokasi }}</td>
            <td>
              @php
                $statusClass = match($report->status) {
                  'proses' => 'badge-proses',
                  'selesai' => 'badge-selesai',
                  default => 'badge-baru',
                };
              @endphp
              <span class="badge {{ $statusClass }}">{{ $report->status }}</span>
            </td>
            <td>{{ $report->created_at->format('d M Y') }}</td>
            <td class="flex gap-1">

              <div class="flex items-center gap-1.5">

              <a href="{{ route('admin.laporan.show',$report->id) }}"
                class="btn-action"
               style="background:#F3F4F6;color:#374151">
              View
              </a>

              <form action="{{ route('admin.laporan.updateStatus',$report->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="proses">
                <button class="btn-action btn-proses">Proses</button>
              </form>

              <form action="{{ route('admin.laporan.updateStatus',$report->id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="selesai">
                <button class="btn-action btn-selesai">Selesai</button>
              </form>

              <form action="{{ route('admin.laporan.destroy',$report->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus?')" class="btn-action btn-hapus">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-10 text-gray-400">
              Belum ada laporan.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-4 py-3 border-t border-gray-100">
      {{ $reports->links() }}
    </div>

  </div>
</div>

@endsection