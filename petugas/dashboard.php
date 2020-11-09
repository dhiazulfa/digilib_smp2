<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">

</head>

<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['nip']==""){
		header("location:../petugas-login.php?pesan=gagal");
	}
 
?>

<body id="page-top">

<div id="container">

<main role="main" class="col-md-auto ml-sm-auto col-lg-12 ">

<!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">Data Anggota</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_anggota/data_anggota.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Data Pengembalian</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_pengembalian/data_pengembalian.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5"> Data Buku </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_buku/data_buku.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5"> Data Kategori </div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_kategori/data_kategori.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>        

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-secondary o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Data Penerbit</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_penerbit/data_penerbit.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">Data Pengarang</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="data_pengarang/data_pengarang.php">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Peminjaman</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th> Nomor </th>
                    <th> ID Pinjam </th>
                    <th> Nama Peminjam</th>
                    <th> Judul Buku </th>
                    <th> Pengarang </th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                </thead>

                <tbody>
                  
<?php
// Load file koneksi.php

include "../koneksi.php";

$no = 0;

$query = "SELECT buku.id_buku, buku.id_pengarang, buku.judul_buku, pengarang.id_pengarang, pengarang.nama_pengarang, anggota.id_anggota, anggota.nama_anggota, peminjaman.id_peminjaman,
peminjaman.id_user, peminjaman.id_buku, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.status FROM peminjaman INNER JOIN anggota ON peminjaman.id_user = anggota.id_anggota INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang"; // Tampilkan semua data 
$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

if($row >= 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
  
  while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
    $no++;
    echo "<tr>";
    echo "<th>$no</th>";
    echo "<td>".$data['id_peminjaman']."</td>";
    echo "<td>".$data['nama_anggota']."</td>";
    echo "<td>".$data['judul_buku']."</td>";  
    echo "<td>".$data['nama_pengarang']."</td>";
    echo "<td>".$data['tgl_pinjam']."</td>";
    echo "<td>".$data['tgl_kembali']."</td>";
    echo "<td>".$data['status']."</td>";
    echo "<td> <a class='btn btn-info' href='edit_status.php?id_peminjaman=$data[id_peminjaman]' target='frmMain'> Edit </td>";
    echo "</tr>";
  }

 } else{ // Jika data tidak ada
  echo "<tr><td colspan='4'>Tidak ada DATA</td></tr>";
}

?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">SMP N 2 Giritontro</div>
        </div>



  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="assets/vendor/chart.js/Chart.min.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="assets/js/demo/datatables-demo.js"></script>
  <script src="assets/js/demo/chart-area-demo.js"></script>

</main>
</div>

</body>

</html>
