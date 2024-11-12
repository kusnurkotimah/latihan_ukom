<?php
/**
 * File: index-barang.php
 * Deskripsi: Berisi kode untuk menampilkan tabel barang yang akan menampilkan id, nama, harga, stok dan aksi 
 * Terdapat tombol tambah yang akan mengarah ke halaman tambah-barang.php
 * Terdapat aksi berupa tombol detail, edit dan hapus
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


//mengimpor file konfigurasi aplikasi
include 'config/app.php';  

//mengambil semua data barang dari database menggunakan fungsi listBarang
$data_barang = listBarang("SELECT * FROM barang");

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="contaner table-container">
        <h2 class="text-center mt-5">Data Barang</h2>
        <a href="tambah-barang.php"><button type="button" class="btn btn-success">Tambah</button></a>
        <table class="table  table-bordered table-striped mt-3">
            <thead class="table-light">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
              <!-- menginterasi data_barang untuk menampilkan setiap barang dalam tabel -->
                <?php foreach ($data_barang as $barang) : ?>
                <tr>
                <th><?php echo $barang['id_barang']; ?></th>
                <td><?php echo $barang ['nama_barang']; ?></td>
                <td>Rp. <?php echo number_format($barang['harga'],0,',','.'); ?></td>
                <td><?php echo $barang ['stok']; ?></td>
                <td>
                    <a href="detail-barang.php?id_barang=<?php echo $barang['id_barang']; ?>"><button type="button" class="btn btn-info">Detail</button></a>
                    <a href="edit-barang.php?id_barang=<?php echo $barang['id_barang']; ?>"><button type="button" class="btn btn-success">Edit</button></a>
                    <a href="hapus-barang.php?id_barang=<?php echo $barang['id_barang']; ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>