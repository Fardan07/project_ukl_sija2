<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    body {
    background-color: white;
    font-family: 'Poppins', sans-serif;
}

    .card {
    background: white;
    border-radius: 12px;
    margin-top: 12px;
    margin-left:30px;
    padding: 16px;
    box-shadow: 0 4px 100px rgba(0,0,0,0.08);
    width: 1180px;
}

    .back {
    background: white;
    border-radius: 12px;
    margin-top: 40px;
    margin-left:30px;
    padding: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    width: fit-content;
}

.back:hover {
    background: #e5e7eb;
}

.back a{
    color:black;
}

    .back p {
        margin: 0;
        font-size: 18px;
}
    .back a{
        text-decoration: none;
}

.judul {
    margin-top:-5px;
    font-size:25px;
}

.dropdown {
    display: inline-block;
    margin-left:0px;
    margin-top:-30px;
}

.tombol {
    width: 260px;
    padding: 10px 14px;
    border-radius: 5px;
    border: 1px solid #e5e7eb;
    background: white;
    color: #111827;
    font-size: 14px;
    cursor: pointer;
    outline: none;
    transition: all 0.2s ease;
}

.tombol:hover {
    border-color: #ef4444;
}

.tombol:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
}

.drop {
    display: inline-block;
    margin-left:11px;
    margin-top:-30px;
}

.pe {
    display: flex;
    align-items: center;
    justify-content: center;

    background: #d92727;
    color: white;
    text-decoration: none;

    height: 37.5px;
    width: 350px;
    margin-left:830px;
    margin-top:-37.5px;

    border-radius: 5px;
    font-weight: 500;
}

.kotak-data {
    background: white;
    border-radius: 12px;
    margin-top: 12px;
    padding: 16px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);

    width: 1150px;
    height: 120px;

    display: flex;
    align-items: flex-start;
    gap: 16px;
}

.gambar-data {
    width: 150px;
    height: 115px;
    object-fit: cover;
    border-radius: 10px;
}

.teks {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.teks h3 {
    margin: 0;
    font-size: 20px;      
    font-weight: 500;     
    color: #1f2937;        
}

.info {
    display: flex;
    gap: 10px;
    font-size: 14px;
    color: #6b7280;
}

.lokasi::before {
    content: "•";
    margin: 0 6px;
}

.tanggal {
    margin: 4px 0 0;
    font-size: 13px;
    color: #9ca3af; 
}

.list{
    display: flex;
    flex-direction: column;
    gap: 12px; 
}

.detail-btn {
    margin-top: 8px;
    display: inline-block;
    width: auto;
    align-self: flex-start;
    padding: 6px 12px;
    border-radius: 8px;
    background: #f3f4f6;  
    color: #111827;
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.detail-btn:hover {
    background: #e5e7eb;
}

.status {
    display: inline-block;
    margin-top: -100px;
    margin-left: 850px; 
    padding: 6px 30px;
    background:#d92727;
    color:white;
    border-radius:5px;
}
.status.belum {
    background: #ef4444;
}

.status.proses {
    background: #f59e0b;
}

.status.selesai {
    background: #10b981;
}
    </style>
</head>
<body>
    
        <div class="back">
            <a href="/#beranda"><p>Kembali</p>
            </a>
        </div>

        <div class="card">
            <p class="judul">Daftar Laporan</p>
            <img src="foto.jpg" alt="">

        <div class="dropdown">
        <select class="tombol" name="kategori">
            <option value="">Pilih Kategori</option>
            <option value="listrik">Listrik</option>
            <option value="toilet">Toilet</option>
            <option value="lab">Lab</option>
        </select>
        </div>

        <div class="drop">
        <select class="tombol" name="kategori">
            <option value="">Status</option>
            <option value="listrik">Diterima</option>
            <option value="toilet">Diproses</option>
            <option value="lab">Selesai</option>
        </select>
        </div>

        <div class="drop">
        <select class="tombol" name="kategori">
            <option value="">Urutkan</option>
            <option value="listrik">Listrik</option>
            <option value="toilet">Toilet</option>
            <option value="lab">Lab</option>
        </select>
        </div>

            <a href="/#form-laporan" class="pe"><p>+ Buat Laporan</p></a>

            <!--Tampilan Data-->
            <div class="list">

@forelse ($reports as $report)
<div class="kotak-data">
    
    <a href="{{ $report->foto ? asset('storage/'.$report->foto) : '#' }}" target="_blank">
        <img class="gambar-data" 
             src="{{ $report->foto ? asset('storage/'.$report->foto) : asset('img/image.png') }}">
    </a>

    <div class="teks">
        <h3>
            {{ \Illuminate\Support\Str::limit($report->deskripsi, 30) }}
        </h3>

        <div class="info">
            <span>Kategori: {{ $report->facility->nama_fasilitas ?? '-' }}</span>
            <span class="lokasi">Lokasi: {{ $report->location->nama_lokasi ?? '-' }}</span>
        </div>

        <p class="tanggal">
            Dilaporkan: {{ $report->created_at->format('d M Y') }}
        </p>

        <a href="#" class="detail-btn">Lihat Detail</a>

        <span class="status {{ $report->status }}">
            {{ ucfirst($report->status) }}
        </span>
    </div>

</div>

@empty
    <p style="margin-top:20px;">Belum ada laporan.</p>
@endforelse

</div>
            </div>

</body>
</html>