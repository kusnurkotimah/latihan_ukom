<?php
/**
 * File: index-barang.php
 * Deskripsi: Berisi kode untuk menghapus barang berdasrakan id_barang 
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


//mengimpor file konfigurasi aplikasi
include 'config/app.php';

//menerima id barang yang dipilih pengguna dari URL dan dan mengkonversinya menjadi integer
$id_barang = (int)$_GET['id_barang'];

/**
 * memanggil fungsi hapusBarang untuk menghapus data barang berdasarkan id_barang
 * jika penghapusan berhasil (kembali lebih dari 0), tampilkan alert sukses dan redirect ke halaman index
 * jika id barang tidak ditemukan, tampilkan alert gagal dan redirect ke halaman index
 */
if (hapusBarang($id_barang) > 0){
    echo "<script>
    alert('Data Barang Berhasil Dihapus');
    document.location.href = 'index.php';
    </script>";
}else{
    echo "<script>
    alert('ID Barang Tidak Ditemukan');
    document.location.href = 'index.php';
    </script>";
}