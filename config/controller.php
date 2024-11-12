<?php

/**
 * File: controller.php
 * Deskripsi: Kumpulan fungsi untuk mengelola data barang dalam aplikasi.
 * 
 * 
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */


/**
 * Fungsi untuk menampilkan data barang dari database 
 * @param $query = string yang berisi perintah SQL untuk mengambil data dari tabel barang
 * 
 * Menggunakan msqli_query untuk mengeksekusi query yang diberikan
 * Menginisialisasi array kosong $rows untuk menyimpan hasil query
 * mysqli_fetch_assoc dalam loop utnuk mengambil setiap baris hasil query sebagai array asosiatif dan menambahkan ke array $rows
 * 
 * Output:
 * Mengembalikan array yang berisi semua baris hasil query. Jika tidak ada data, mengembalikan array kosong.
 * */ 
function listBarang($query){
    //panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    } 
    return $rows;
}


/**
 * Fungsi untuk menyimpan data barangbaru ke dalam database
 * @param $post = aaray yang berisi data barang yang akan disimpan, biasanya berasal dari form input (POST request)
 * 
 * Mengambil data dari array $post untuk ID, nama, harga, stok barang
 * Memanggil fungsi uploadFile() untuk mengupload foto barang dan mendapatkan nama file yang baru
 * Menyusun query SQL untuk memasukkan data barang ke dalam tabel barang
 * Menajalankan query menggunakan mysqli_query
 * 
 * Output:
 * Mengembalikkan jumlah baris yang terpengaruh oleh query INSERT, yang menunjukkan apakah penyimpanan berhasil atau tidak
 * 
 */
function simpanBarang($post){
    //panggil koneksi database
    global $db;

    $id_barang = $post['id'];
    $nama_barang = $post['nama'];
    $harga = $post['harga'];
    $stok = $post['stok'];
    $foto = uploadFile();
      

    //query tambah data
    $query = "INSERT INTO barang (id_barang, nama_barang, harga, stok, foto) VALUES ('$id_barang', '$nama_barang', '$harga', '$stok', '$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



/**
 * fFungsi untuk mengubah data barang yang sudah ada di database
 * @param $post = array yang berisi data barang yang akan diupdate, biasanya berasal dari form input(POST request)
 * 
 * Mengambil data dari array $post untuk Id, nama, harga, stok, dan foto lama
 * Memeriksa apakah ada foto baru yang dipload. Jika tidak, menggunakan foto lama
 * Menyusun query SQL untuk memperbarui data barang di tabel barang
 * Menjalankan query menggunakan mysqli_query
 * 
 * Output:
 * Mengembalikan jumlah baris yang terpengaruh oleh query UPDATE, yang menunjukkna apkaah pembaruan berhasil atau tidak
 */
function updateBarang($post){
    //panggil koneksi database
    global $db;

    $id_barang = $post['id'];
    $nama_barang = $post['nama'];
    $harga = $post['harga'];
    $stok = $post['stok'];
    $fotoLama = $post['fotoLama'];
    
    //check upload foto baru atau tidak
    if($_FILES['foto']['error'] == 4){
        $foto = $fotoLama;
    }else{
        $foto = uploadFile();
    }

    //query ubah data
    $query = "UPDATE barang SET id_barang ='$id_barang', nama_barang ='$nama_barang', harga ='$harga', stok ='$stok', foto ='$foto' WHERE id_barang ='$id_barang' ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

/**
 * Fungsi untuk hapus data barang dari database berdasarkan ID yang diberikan
 * @param $id_barang = ID barang yang akan dihapus dari tabel barang
 * 
 * Menyusun query SQL untuk menghapus data barang dari tabel barang berdasarkan ID yang diberikan
 * Menjalankan query menggnakan mysqli_query
 * 
 * Output:
 * Mengembalikkan jumlah baris yang terpengaruh oleh query DELETE, yang menunjukkan apakah penghapusan berhasil atau tidak.
 * jika tidak ada baris yang dihapus, maka nilai yang dikembalikkan 0
 */
function hapusBarang($id_barang){
    //panggil koneksi database
    global $db;

    //query hapus data barang
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

/**
 * Fungsi untuk mengupload file gambar dan memvalidasi format serta ukuran file yang diuplad
 * 
 * Mengambil informasi yang diupload, termasuk nama file, ukuran file, dan lokasi sementara file
 * Mendefinisikan array $extensifileValid yang berisi foemat file yang diizinkan seperti jpg, jpeg, png
 * Memeriksa apakah extensi file yang diupload dengan membandingkan dengan array yang telah ditentukan
 * jika tidak valid, menampilkan pesan kesalahan dan mengarahkan kembali ke halaman 'tambah-barang.php'
 * Memeriksa ukuran file untuk memastikan tidaklebih dari 2 MB.
 * jika ukuran file melebihi batas, menampilka pesan kesalahan dan mengarahkan kembali ke halaman 'tambah-barang.php'
 * Menghasilkan nama file baru yang unik menggunakan uniqid() untuk menghindari konflik nama file
 * Memindahkan file yang diupload dari lokasi sementara ke folder tujuan 'assets/img/'
 * Mengembalikkan nama  file baru yang telah diupload
 * 
 * Output:
 * Mengembalikkan nama file baru yang telah diupload, yang dapat digunakan untuk menyimpan informasi di database 
 */
function uploadFile(){
    $namaFile   = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];

    //cek file yang diupload
    $extensifileValid = ['jpg','jpeg','png'];
    $extensifile = explode('.', $namaFile); 
    $extensifile = strtolower(end($extensifile));

    //check format/extensi file
    if (!in_array($extensifile, $extensifileValid)){
        //pesan gagal
        echo "<script>
        alert('Format File Tidak Valid)
        document.location.href = 'tambah-barang.php';
        </script>";
        die();
    }

    //check ukuran file
    if ($ukuranFile > 2048000){
        echo "<script>
        alert('Ukuran File Max 2 MB')
        document.location.href = 'tambah-barang.php';
        </script>";
        die();
    }

    //generate nama file baru
    $namaFileBaru = uniqid() . '.' . $extensifile;


    //pindahkan ke local folder
    move_uploaded_file($tmpName, 'assets/img/'. $namaFileBaru);
    return $namaFileBaru;

}