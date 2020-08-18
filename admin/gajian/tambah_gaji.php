<?php 
include '../../koneksi.php';
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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    
    
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
                    <a class="nav-link" href="../data_karyawan.php">Data Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../data_jabatan.php">Data Jabatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../data_pinjaman.php">Data Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../absen_karyawan.php">Absen Karyawan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../gajian.php">Data Gaji</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Laporan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="../laporan/laporan_karyawan.php">Laporan Data Karyawan</a>
                        <a class="dropdown-item" href="../laporan/laporan_absen.php">Laporan Absen Karyawan</a>
                        <a class="dropdown-item" href="../laporan/laporan_gaji.php">Laporan Gaji Karyawan</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                session_start();
                if($_SESSION['level']=="" || $_SESSION['level'] != "admin"){
                    echo '<script>alert("Ilegal URL"); document.location="../.././";</script>';
                    session_destroy();
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../user.php<?php echo '?id='.$_SESSION['id']; ?>"><i class="fas fa-user-alt"></i><?php $nama=explode(" ", $_SESSION['nama']); echo " ".$nama[0]; ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Keluar</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <main role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <br><br>
                <h1 class="display-3">Data Gaji Karyawan</h1>
            </div>
        </div>

        <div class="container">
            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Tambah Data Gajian</h5>
                    
                    <?php
                    if(isset($_POST['submit'])){
                        // id, periode, nik, nama, jabatan, bagian, jml masuk, gaji pokok, jml lembur, 
                        // uang lembur, bpjstk, bpjspen, bpjskes, pph, pinjaman
                        $umr = 4500000;
                        $harian = 150000;
                        $jamlembur = 25500;
                        $periode = $_POST['periode'];
                        $nik = $_POST['nik'];
                        $nama = $_POST['nama'];
                        $jbtan = $_POST['jabatan'];
                        $bgian = $_POST['bgian'];
                        $jmlmasuk = $_POST['jmlmasuk'];
                        $jmllembur = $_POST['jmllembur'];
                        if(isset($_POST['bpjstk'])){
                            $bpjstk = 4409000*0.02;
                        }
                        else{
                            $bpjstk = 0;
                        }
                        if(isset($_POST['bpjspen'])){
                            $bpjspen = 4409000*0.01;
                        }
                        else{
                            $bpjspen = 0;
                        }
                        if(isset($_POST['bpjskes'])){
                            $bpjskes = 4409000*0.01;
                        }
                        else{
                            $bpjskes = 0;
                        }
                        $cekpinjam = mysqli_query($conn, "select * from pinjaman where nik='$nik' and carapenge='Potong Gaji'");
                        if($cekpinjam){
                            $data = mysqli_fetch_array($cekpinjam);
                            $pinjaman = $data['pinjaman'];
                        }
                        else{
                            $pinjaman = 0;
                        }
                        if($jmllembur == ""){
                            $lembur = 0;
                        }
                        else{
                            $lembur = $_POST['jmllembur'];
                        }
                        $gpokok = $jmlmasuk*$harian;
                        $uanglembur = $lembur*$jamlembur;
                        $gkotor = $gpokok+$uanglembur;
                        if($gkotor > $umr){
                            $pph = 20000;
                        }
                        else{
                            $pph = 0;
                        }
                        $tgl = date("Y-m-d");
                        $query=mysqli_query($conn, "insert into tbgaji(id, periode, nik, nama, jabatan, bagian, jmlmasuk, gajipokok, jmllembur, uanglembur, bpjstk, bpjspen, bpjskes, pph, pinjaman, tglup)
                        values (NULL, '$periode', '$nik', '$nama', '$jbtan', '$bgian', '$jmlmasuk', '$gpokok', '$lembur', '$uanglembur', '$bpjstk', '$bpjspen', '$bpjskes', '$pph', '$pinjaman', '$tgl')") or die(mysqli_error($conn));
                        if($query){
                            echo '<script>alert("Berhasil menyimpan data."); document.location="../gajian.php";</script>';
                        }
                        else{
                            echo '<div class="alert alert-warning">'.$pinjaman.'!</div>';
                        }
                    }
                    ?>

                    <br>
                    <form class="form-signin" action="tambah_gaji.php" method="POST">
                        <div class="form-label-group">
                            <input type="text" id="periode" name="periode" class="form-control" placeholder="Periode" required  autofocus>
                        </div>
                        <br>
                        
                        <div class="form-label-group">
                            <input type="text" id="nik" name="nik" class="form-control" placeholder="N I K" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <select class="form-control" id="jabatan" name="jabatan">
                                <option value="">Jabatan</option>
                            <?php
                            $query=mysqli_query($conn, "select jbtan, COUNT(*) as j from jabatan GROUP BY jbtan HAVING j>=1 ORDER BY j asc");
                            while($row=mysqli_fetch_array($query)){
                                echo '<option value="'.$row['jbtan'].'">'.$row['jbtan']."</option>";
                            }
                             ?>
                        </select>
                        </div>
                        <br>
                            
                        <div class="form-label-group">
                            <select class="form-control" id="bgian" name="bgian">
                                <option value="">Bagian</option>
                            <?php
                            $query=mysqli_query($conn, "SELECT bagian FROM jabatan ORDER by jbtan ASC");
                            while($row=mysqli_fetch_array($query)){
                                echo '<option value="'.$row['bagian'].'">'.$row['bagian']."</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="jmlmasuk" name="jmlmasuk" class="form-control" placeholder="Jumlah Masuk (Hari)" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="jmllembur" name="jmllembur" class="form-control" placeholder="Jumlah Lembur (Jam)">
                        </div>
                        <br>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="bpjstk" name="bpjstk">
                            <label class="form-check-label" for="bpjstk">BPJS Tenaga Kerja</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="bpjspen" name="bpjspen">
                            <label class="form-check-label" for="bpjspen">BPJS Jaminan Pensiun</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="bpjskes" name="bpjskes">
                            <label class="form-check-label" for="bpjskes">BPJS Kesehatan</label>
                        </div>
                        <br>
              
                        <hr>
                        <button class="btn btn-success btn-block" type="submit" name="submit">Simpan</button>
                        <a class="btn btn-danger btn-block" href="../gajian.php" role="button"> Kembali </a>

                    </form>
                </div>
            </div>
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