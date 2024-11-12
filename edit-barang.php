<?php
/**
 * File: edit-barang.php
 * Deskripsi: Berisi kode yang menampilkan form untuk edit barang 
 * Terdapat kolom id, nama barang, harga, stok dan upload foto yang sudah terisi otomatis 
 * Terdapat tombol update untuk mengirim update data barang ke tabel di index.php
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


//mengimpor file konfigurasi aplikasi
include 'config/app.php';

//mengambil id_barang dari url dan mengkonversinya menjadi integer
$id_barang = (int)$_GET['id_barang'];

//mengambil data barang berdasarkan id_barang yang diberikan 
$barang = listBarang("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

//memeriksa apakah tombol submit 'update' telah ditekan
if (isset($_POST['update'])){
    /**
     * memanggil fungsi updateBarang dan memeriksa apakah data barang diperbarui
     * jika berhasil, tampilkan alert dan redirect ke halaman index
     * jika tidak ada perubahan, tampilkan alert dan redirect ke halaman index
     */
    if (updateBarang($_POST) > 0){
        echo "<script>
        alert('Data Barang Berhasil Diubah');
        document.location.href = 'index.php';
        </script>";
    }else{
        echo "<script>
        alert('Tidak Ada Perubahan');
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
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
        <h2 class="text-center">Edit Barang</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="fotoLama" value="<?php echo $barang['foto']; ?>">
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="id" value="<?php echo $barang['id_barang']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang ......" value="<?php echo $barang['nama_barang']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang ......" value="<?php echo $barang['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok Barang</label>
                <input type="text" class="form-control" id="stok" name="stok" placeholder="Stok Barang ......" value="<?php echo $barang['stok']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <p>
                    <small>Gambar Sebelumnya</small>
                </p>
                <img src="assets/img/<?php echo $barang['foto']; ?>" alt="foto" width="100px">
            </div>
            <button type="submit" name="update" class="btn btn-primary" style="float:right;">Update</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>