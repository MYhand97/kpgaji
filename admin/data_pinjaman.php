<?php 
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GajiKu-AdminScreen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="./dashboard.php">GajiKu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">    
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="data_karyawan.php">Data Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="data_jabatan.php">Data Jabatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">Data Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="absen_karyawan.php">Absen Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gajian.php">Data Gaji</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Laporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="laporan/laporan_karyawan.php">Laporan Data Karyawan</a>
                        <a class="dropdown-item" href="laporan/laporan_absen.php">Laporan Absen Karyawan</a>
                        <a class="dropdown-item" href="laporan/laporan_gaji.php">Laporan Gaji Karyawan</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                session_start();
                if($_SESSION['level']=="" || $_SESSION['level'] != "admin"){
                    echo '<script>alert("Ilegal URL"); document.location=".././";</script>';
                    session_destroy();
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="user.php<?php echo '?id='.$_SESSION['id']; ?>"><i class="fas fa-user-alt"></i><?php $nama=explode(" ", $_SESSION['nama']); echo " ".$nama[0]; ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <main role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <br><br>
                <h1 class="display-3">Data Pinjaman</h1>
            </div>
        </div>

        <div class="form-inline d-flex justify-content-center md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Cari..." id="cari" name="cari">
            <a class="btn btn-success ml-3" href="data_pinjaman/tambah_pinjaman.php" role="button">Tambah Data</a>
        </div>

        <div class="container-fluid table-responsive-xl">
            <br>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Bagian</th>
                        <th scope="col">J.Pinjaman</th>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Jangka Waktu</th>
                        <th scope="col">Tgl Penyerahan</th>
                        <th scope="col">Tgl Pengembalian</th>
                        <th scope="col">Cara Pengembalian</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    $no = 1;
                    $query = mysqli_query($conn, "select * from pinjaman order by nama asc");
                    while($row = mysqli_fetch_array($query)){
                        echo '<tr>';
                        echo '<th scope="row">'.$no.'</th>';
                        echo '<td>'.$row['nik'].'</td>';
                        echo '<td>'.$row['nama'].'</td>';
                        echo '<td>'.$row['jabatan'].'</td>';
                        echo '<td>'.$row['bagian'].'</td>';
                        echo '<td>'.$row['pinjaman'].'</td>';
                        echo '<td>'.$row['kperluan'].'</td>';
                        echo '<td>'.$row['waktu'].'</td>';
                        echo '<td>'.$row['tglpenye'].'</td>';
                        echo '<td>'.$row['tglpenge'].'</td>';
                        echo '<td>'.$row['carapenge'].'</td>';
                        echo '<td>
                        <a class="btn btn-warning btn-sm" href="data_pinjaman/edit_pinjaman.php?id='.$row['id'].'" role="button">Edit</a>
                        <a class="btn btn-danger btn-sm" href="data_pinjaman/hapus_pinjaman.php?id='.$row['id'].'" role="button" onclick="return confirm(\'yakin ingin menghapus data ini?\')">Hapus</a>
                        </td>';
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="page-footer font-small">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-5">
            © 2020 MYhand, all rights reserved. Made with <i class="fas fa-heart"></i> for a better web
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        $("#cari").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
</body>
</html>