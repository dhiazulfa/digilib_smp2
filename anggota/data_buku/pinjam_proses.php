<?php

include ('../../koneksi.php');

if(isset($_POST['addPinjam'])) {

$id_user        = $_POST['id_anggota'];
$id_buku        = $_POST['id_buku'];
$tgl_pinjam     = $_POST['tgl_pinjam'];
$tgl_kembali    = $_POST['tgl_kembali'];
$jumlah         = $_POST['jumlah'];

$stok           = $_POST['stok'];

$stok_akhir     = $stok-$jumlah;

$cek_peminjaman    = mysqli_query($conn, "SELECT id_user FROM peminjaman WHERE id_user='$id_user' ");
$check          = mysqli_num_rows($cek_peminjaman);

if($check>0){
echo '<script language="javascript">alert("Maaf anda sudah pinjam"); document.location="../index.php"; </script>';
}

else {

$sql            = mysqli_query($conn, "INSERT INTO peminjaman(id_user, id_buku, tgl_pinjam, tgl_kembali, jumlah) 
                VALUES ('$id_user', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$jumlah')" );
    if ($sql){
        
        $sql2   = mysqli_query($conn, "UPDATE buku SET stok='$stok_akhir' WHERE id_buku = '$id_buku' ");
        
        if ($sql2) {
            echo '<script language="javascript">alert("Peminjaman Berhasil!"); document.location="../index.php"; </script>';
            }
        }
    }
}
?>