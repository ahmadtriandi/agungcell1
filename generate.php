<?php
  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass);

//periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }

//buat database counter jika belum ada 
$query = "CREATE DATABASE IF NOT EXISTS counter";
$result = mysqli_query($link,$query);

if(!$result){
    die ("query error: ".mysqli_errno($link).
         " - ".mysqli_error($link)); 
}
else {
    echo "Database <b>'counter'</b> berhasil dibuat...<br>";
}

//pilih database counter
$result = mysqli_select_db($link, "counter");

 if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
else {
    echo "database <b>'counter'</b> berhasil dipilih...<br>";
}

//cek apakah tabel barang_beli sudah ada. jika ada, hapus tabel
$query = "DROP TABLE IF EXISTS barang_beli";
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'barang_beli'</b> berhasil dihapus... <br>";
  }
// buat query  untuk CREATE table barang_beli
$query = "CREATE TABLE barang_beli (sn CHAR(8), merek VARCHAR(100), model VARCHAR(100), tgl_beli DATE, harga INTEGER(20), karyawan VARCHAR(100), jumlah INTEGER(5), PRIMARY KEY (sn))";
$hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'barang_beli'</b> berhasil dibuat... <br>";
  }
  
   // buat query untuk INSERT data ke tabel barang_beli 
$query = "INSERT INTO barang_beli VALUES ('00000001', 'Samsung', 'galaxy tab A', '2017-08-17', '2000000', 'opik','1'), ('00000002', 'Apple', 'IPHONE 5', '2017-09-20', '4000000', 'reza','1')";
$hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'barang_beli'</b> berhasil diisi... <br>";
  }
// cek apakah tabel admin sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS admin";
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dihapus... <br>";
  }
  
  // buat query untuk CREATE tabel admin
  $query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))"; 
  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dibuat... <br>";
  }
  
  // buat username dan password untuk admin
  $username = "admin123";
  $password = sha1("rahasia");
  
  // buat query untuk INSERT data ke tabel admin
  $query  = "INSERT INTO admin VALUES ('$username','$password')"; 

  $hasil_query = mysqli_query($link, $query);
  
  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
  }
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>

         