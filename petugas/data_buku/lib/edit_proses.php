<?php
// Load file koneksi.php
include "../../../koneksi.php";

// Ambil Data yang Dikirim dari Form
$id_buku       = $_POST['id_buku'];
$id_pengarang  = $_POST['id_pengarang'];
$id_penerbit   = $_POST['id_penerbit'];
$id_kategori   = $_POST['id_kategori'];
$isbn          = $_POST['isbn'];
$judul_buku    = $_POST['judul_buku'];
$tahun_terbit  = $_POST['tahun_terbit'];
$halaman       = $_POST['halaman'];
$stok          = $_POST['stok'];
$deskripsi     = $_POST['deskripsi'];

$gambar        = $_FILES['gambar']['name'];
$tipe          = $_FILES['gambar']['type'];
$tmp_file      = $_FILES['gambar']['tmp_name'];

// Set path folder tempat menyimpan gambarnya
$path = "../../assets/images/".$gambar;

if($tipe == "image/jpg" || $tipe == "image/jpeg"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
	// Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
      // Jika gambar berhasil diupload, Lakukan :	
      // Proses simpan ke Database
      $query = "UPDATE buku SET id_kategori='$id_kategori', id_penerbit='$id_penerbit', id_pengarang='$id_pengarang', isbn='$isbn', judul_buku='$judul_buku', 
      tahun_terbit='$tahun_terbit', halaman='$halaman', deskripsi='$deskripsi', stok='$stok', gambar='".$gambar."', tipe='".$tipe."' WHERE id_buku='$id_buku' ";
      $sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
      
      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        echo '<script language="javascript">alert("Data Buku berhasil diperbaharui!"); document.location="../data_buku.php"; </script>';
      }else{
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='gambar.php'>Kembali Ke Form</a>";
      }
    }else{
      // Jika gambar gagal diupload, Lakukan :
      echo "Maaf, Gambar gagal untuk diupload.";
      echo "<br><a href='gambar.php'>Kembali Ke Form</a>";
    }
}else{
	// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
	echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
	echo "<br><a href='gambar.php'>Kembali Ke Form</a>";
  }
?>