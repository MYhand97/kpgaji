<?php 
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>GajiKu-KaryawanScreen</title>
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
                    <a class="nav-link" href="pinjaman.php">Pengajuan Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="gaji.php">Lihat Gaji</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                session_start();
                if($_SESSION['level']=="" || $_SESSION['level'] != "karyawan"){
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
                <h1 class="display-3">Gaji Karyawan</h1>
            </div>
        </div>

        <div class="form-inline d-flex justify-content-center md-form form-sm mt-0">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Cari..." id="cari" name="cari">
        </div>

        <div class="container-fluid table-responsive-xl">
            <br>
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Periode</th>
                        <th scope="col">Jml Masuk</th>
                        <th scope="col">Gaji Pokok</th>
                        <th scope="col">Jml Lembur</th>
                        <th scope="col">Uang Lembur</th>
                        <th scope="col">Pph21</th>
                        <th scope="col">Pinjaman</th>
                        <th scope="col">BPJS-TK</th>
                        <th scope="col">BPJS-JP</th>
                        <th scope="col">BPJS-Kes</th>
                        <th scope="col">Gaji Bersih</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    $query = mysqli_query($conn, "select * from tbgaji where nik='".$_SESSION['nik']."' order by periode asc");
                    if(mysqli_num_rows($query) > 0){
                        $no = 1;
                        while($row = mysqli_fetch_array($query)){
                            $gkotor = 0;
                            $gkotor = $row['gajipokok']+$row['uanglembur'];
                            $deduction = 0;
                            $deduction = $row['pph']+$row['pinjaman']+$row['bpjstk']+$row['bpjspen']+$row['bpjskes'];
                            $gbersih = 0;
                            $gbersih = $gkotor-$deduction;
                            echo '<tr>';
                            echo '<th scope="row">'.$no.'</th>';
                            echo '<td>'.$row['periode'].'</td>';
                            echo '<td>'.$row['jmlmasuk'].'</td>';
                            echo '<td>'.number_format($row['gajipokok'],0,'','.').'</td>';
                            echo '<td>'.$row['jmllembur'].'</td>';
                            echo '<td>'.number_format($row['uanglembur'],0,'','.').'</td>';
                            echo '<td>'.number_format($row['pph'],0,'','.').'</td>';
                            echo '<td>'.number_format($row['pinjaman'],0,'','.').'</td>';
                            echo '<td>'.number_format($row['bpjstk'],0,',','.').'</td>';
                            echo '<td>'.number_format($row['bpjspen'],0,'','.').'</td>';
                            echo '<td>'.number_format($row['bpjskes'],0,'','.').'</td>';
                            echo '<td>'.number_format($gbersih,0,'','.').'</td>';
                            echo '<td>
                            <a class="btn btn-success btn-sm" href="gaji/lihat_gaji.php?id='.$row['id'].'" role="button">Lihat Gaji</a>
                            </td>';
                            $no++;
                        }
                    }
                    else{
                        echo '
                        <tr>
                            <td scope="row" align="center" colspan="13" class="bg-danger">Tidak ada data!</td>
                        </tr>
                        ';
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
</body>
</html>