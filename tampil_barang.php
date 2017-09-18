  <?php
  // periksa apakah user sudah login, cek kehadiran session name 
  // jika tidak ada, redirect ke login.php
  session_start();
  if (!isset($_SESSION["nama"])) {
     header("Location: login.php");
  }

  // buka koneksi dengan MySQL
     include("connection.php");
  
  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
      $pesan = $_GET["pesan"];
  }
     
  // cek apakah form telah di submit
  // berasal dari form pencairan, siapkan query 
  if (isset($_GET["submit"])) {
      
    // ambil nilai nama
    $merek = htmlentities(strip_tags(trim($_GET["merek"])));
    
    // filter untuk $nama untuk mencegah sql injection
    $merek = mysqli_real_escape_string($link,$merek);
      
       // buat query pencarian
    $query  = "SELECT * FROM barang_beli WHERE merek LIKE '%$merek%' ";
    $query .= "ORDER BY merek ASC";
      
      // buat pesan
    $pesan = "Hasil pencarian untuk merek <b>\"$merek\" </b>:";
      } 
  else {
  // bukan dari form pencairan
  // siapkan query untuk menampilkan seluruh data dari tabel barang
    $query = "SELECT * FROM barang_beli ORDER BY merek ASC";
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Agung</title>
  <link href="style.css" rel="stylesheet" >
  <link rel="icon" href="android.png" type="image/png" >
</head>
    <body>
<div class="container">
<div id="header">
  <h1 id="logo">Aplikasi <span>Agung</span></h1>
  <p id="tanggal"><?php echo date("d M Y"); ?></p>
</div>
    <hr>
  <nav>
  <ul>
    <li><a href="tampil_barang.php">Tampil</a></li>
    <li><a href="tambah_barang.php">Tambah</a>
    <li><a href="edit_barang.php">Edit</a>
    <li><a href="hapus_barang.php">Hapus</a></li>
    <li><a href="logout.php">Logout</a>
  </ul>
  </nav>
    <form id="search" action="tampil_barang.php" method="get">
    <p>
      <label for="sn">Merek : </label> 
      <input type="text" name="merek" id="merek" placeholder="search..." >
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
    <h2>Data Barang</h2>
    <?php
  // tampilkan pesan jika ada
  if (isset($pesan)) {
      echo "<div class=\"pesan\">$pesan</div>";
  }
?>
    <table border="1">
  <tr>
  <th>SN</th>
  <th>Merek</th>
  <th>Model</th>
  <th>Tanggal Beli</th>
  <th>harga</th>
  <th>Karyawan</th>
  <th>Jumlah</th>
  </tr>
        
        <?php
  // jalankan query
  $result = mysqli_query($link, $query);
  
  if(!$result){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
        //buat perulangan untuk element tabel dari data barang_beli
  while($data = mysqli_fetch_assoc($result))
  { 
    // konversi date MySQL (yyyy-mm-dd) menjadi dd-mm-yyyy
    $tanggal_php = strtotime($data["tgl_beli"]);
    $tanggal = date("d - m - Y", $tanggal_php);
    
    echo "<tr>";
    echo "<td>$data[sn]</td>";
    echo "<td>$data[merek]</td>";
    echo "<td>$data[model]</td>";
    echo "<td>$tanggal</td>";
    echo "<td>$data[harga]</td>";
    echo "<td>$data[karyawan]</td>";
    echo "<td>$data[jumlah]</td>";
    echo "</tr>";
  }
    // bebaskan memory 
  mysqli_free_result($result);
  
  // tutup koneksi dengan database mysql
  mysqli_close($link);
  ?>
  </table>
  <div id="footer">
    Copyright © <?php echo date("Y"); ?> 3andi.xyz
  </div>
</div>
</body>
</html>