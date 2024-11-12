<?php
/**
 * File: database.php
 * Deskripsi: Kode untuk membuat koneksi ke database MySql menggunakan mysqli_connect
 * 
 * @param localhost = host tempat server database berada
 * @param root = nama pengguna untuk koneksi ke database, pmenggunakan pengguna default 'root'
 * @param '' = kata sandi untuk pengguna (disini tidak ada kata sandi yang diberikan)
 * @param crud-ukom = nama database yang ingin diakses
 * 
 * mysqli_connect = fungsi untuk koneksi ke dtabase MySql 
 *
 * Author: Kusnur Kotimah
 * Version : 1.0
 * Tanggal: 13 November 2024
 */

$db = mysqli_connect('localhost', 'root', '', 'crud-ukom');
