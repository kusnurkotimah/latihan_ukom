<?php
/**
 * File: detail-barang.php
 * Deskripsi: Berisi kode yang menampilkan detail barang dari id_barang yang di cari 
 * Terdapat informasi id, nama barang, harga, stok, dan upload foto
 * Terdapat kembali yang akan mengarahkan ke halaman index.php
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


//mengimpor file konfigurasi aplikasi
include 'config/app.php';  

//mengambil id barang dari url dan mengkonversinya menjadi integer
$id_barang = (int)$_GET['id_barang'];

//mengambil data barang berdasarkan id_barang dari database dan menyimpannya dalam variabel $barang
$barang = listBarang("SELECT * FROM barang WHERE id_barang = $id_barang")[0];

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="contaner mt-5">
        <h2 class="text-center">Detail Barang <?php echo $barang['nama_barang']; ?></h2>
        <table class="table  table-bordered table-striped mt-3">
            <tr>
                <td>Foto</td>
                <td>
                    <a href="assets/img/<?php echo $barang['foto']; ?>">
                        <img src="assets/img/<?php echo $barang['foto']; ?>" alt="<?php echo $barang['nama_barang']; ?>" width="25%">
                    </a>
                </td>
            </tr>
            </tr>
            <tr>
                <td>ID</td>
                <td>: <?php echo $barang['id_barang']; ?></td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>: <?php echo $barang['nama_barang']; ?></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>: <?php echo $barang['harga']; ?></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>: <?php echo $barang['stok']; ?></td>
            </tr>
        </table>

        <a href="index.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>