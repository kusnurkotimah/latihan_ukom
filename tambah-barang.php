<?php
/**
 * File: tambah-barang.php
 * Deskripsi: Berisi kode yang menampilkan form untuk tambah barang 
 * Terdapat kolom id, nama barang, harga, stok, dan upload foto yang akan diisi oleh pengguna (user)
 * Terdapat tombol tambah untuk menambahkan data barang ke tabel di index.php
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


//mengimpor file konfigurasi aplikasi 
include 'config/app.php';

//memeriksa apakah tombol submit 'simpan' telah ditekan
if (isset($_POST['simpan'])){
    /**
     * memanggil fungsi simpanBarang dan memeriksa apakah data berhasil disimpan
     * jika berhasil, tampilkan alert dan redirect ke halaman index
     * jika gagal, tampilkan alert dan redirect ke halaman index
     */
    if (simpanBarang($_POST) > 0){
        echo "<script>
        alert('Data Barang Berhasil Ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('Data Barang Gagal Ditambahkan');
        document.location.href = 'index.php';
        </script>";
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="contaner mt-5">
        <h2 class="text-center">Tambah Barang</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="id" placeholder="Masukkan ID" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang ......" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang ......" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok Barang</label>
                <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Barang ......" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary" style="float:right;">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>