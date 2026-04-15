<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Saya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    body {
    background-color: black;
    font-family: 'Poppins', sans-serif;
}

    .card {
    background: white;
    border-radius: 12px;
    margin-top: 12px;
    margin-left:30px;
    padding: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    width: 1180px;
    height:390px;
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

.search-box {
    display: flex;
    gap: 10px;
    margin: -30px 0;
    width: 350px;
}

.search-box input {
    flex: 1;
    padding: 10px 14px;
    border-radius: 5px;
    border: 1px solid #ddd;
    outline: none;
}

.search-box button {
    padding: 10px 16px;
    border: none;
    border-radius: 5px;
    background: #d92727;
    color: white;
    cursor: pointer;
}

.search-box button:hover {
    background: #dc2626;
}

.dropdown {
    display: inline-block;
    margin-left:365px;
    margin-top:-30px;
}

.tombol {
    width: 200px;
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
    width: 300px;
    margin-left:790px;
    margin-top:-37.5px;

    border-radius: 5px;
    font-weight: 500;
}
    </style>
</head>
<body>
    
        <div class="back">
            <a href="#kembali"><p>Kembali</p>
            </a>
        </div>

        <div class="card">
            <p class="judul">Daftar Laporan</p>
            <img src="foto.jpg" alt="">

        <div class="search-box">
            <input type="text" placeholder="Cari laporan...">
            <button>Cari</button>
        </div>

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
            <option value="listrik">Listrik</option>
            <option value="toilet">Toilet</option>
            <option value="lab">Lab</option>
        </select>
        </div>

            <a href="gaweform" class="pe"><p>+ Buat Laporan</p></a>

        </div>

</body>
</html>