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
                    <a class="nav-link active" href="../data_karyawan.php">Data Karyawan</a>
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
                    <a class="nav-link" href="../gajian.php">Data Gaji</a>
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
                <h1 class="display-3">Data Karyawan</h1>
            </div>
        </div>

        <div class="container">
            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Edit Data Karyawan</h5>
                    <?php
                    if(isset($_GET['id'])){
                        $id=$_GET['id'];
                        $select = mysqli_query($conn, "select * from dtkaryawan where id='$id'") or die(mysqli_error($conn));
                        if(mysqli_num_rows($select) == 0){
                            echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				            exit();
			                //jika hasil query > 0
			            }else{
				            //membuat variabel $data dan menyimpan data row dari query
				            $data = mysqli_fetch_assoc($select);
			            }
		            }
                    ?>
                    <?php
                    if(isset($_POST['submit'])){
                        $nik = $_POST['nik']; //1
                        $nama = $_POST['nama']; //2
                        $jbtan = $_POST['jabatan']; //3
                        $bagian = $_POST['bgian']; //4
                        $tglMasuk = $_POST['tglmasuk']; //5
                        $jkmsg = $_POST['jk']; //6
                        if($jkmsg == 1){
                            $jk = 'L';
                        }
                        else{
                            $jk = 'P';
                        }
                        $nktp = $_POST['noktp']; //7
                        $tmptLahir = $_POST['tmptlahir']; //8
                        $tglLahir = $_POST['tgllahir']; //9
                        $nkk = $_POST['nokk']; //10
                        $alamat = $_POST['alamat']; //11
                        $nmibu = $_POST['nmibu']; //12
                        $npwp = $_POST['npwp']; //13
                        $bpjstk = $_POST['bpjstk']; //14
                        $bpjspen = $_POST['bpjspen']; //15
                        $bpjskes = $_POST['bpjskes']; //16
                        $norek = $_POST['norek']; //17
                        $notelp = $_POST['notelp']; //18
                        $query=mysqli_query($conn, "update dtkaryawan set nik='$nik', nama='$nama', jabatan='$jbtan', bagian='$bagian', 
                        tglmasuk='$tglMasuk', jk='$jk', noktp='$nktp', tmptlahir='$tmptLahir', tgllahir='$tglLahir', nokk='$nkk', 
                        alamat='$alamat', nmibu='$nmibu', npwp='$npwp', bpjstk='$bpjstk', bpjspensi='$bpjspen', bpjskes='$bpjskes', 
                        norek='$norek', notelp='$notelp' where id='$id'") or die(mysqli_error($conn));
                        if($query){
                            echo '<script>alert("Berhasil menyimpan data."); document.location="../data_karyawan.php";</script>';
                        }
                        else{
                            echo '<div class="alert alert-warning">Gagal Query.</div>';
                        }
                    }
                    ?>
                    <form class="form-signin" action="edit_karyawan.php?id=<?php echo $id; ?>" method="POST">
                        <div class="form-label-group">
                            <input type="text" id="nik" name="nik" class="form-control" placeholder="N I K" value="<?php echo $data['nik']; ?>" required autofocus>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $data['nama']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <select class="form-control" id="jabatan" name="jabatan">
                                <option value="">Jabatan</option>
                            <?php
                            $query=mysqli_query($conn, "select jbtan, COUNT(*) as j from jabatan GROUP BY jbtan HAVING j>=1 ORDER BY j asc");
                            while($row=mysqli_fetch_array($query)){ ?>
                                <option value="<?php echo $row['jbtan']; ?>" <?php if($data['jabatan'] == $row['jbtan']){ echo "selected"; } ?>><?php echo $row['jbtan']; ?> </option>
                            <?php } ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <select class="form-control" id="bgian" name="bgian">
                                <option value="">Bagian</option>
                            <?php
                            $query=mysqli_query($conn, "SELECT bagian FROM jabatan ORDER by jbtan ASC");
                            while($row=mysqli_fetch_array($query)){ ?>
                                <option value="<?php echo $row['bagian']; ?>" <?php if($data['bagian'] == $row['bagian']){ echo "selected"; } ?>><?php echo $row['bagian']; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input id="tglmasuk" name="tglmasuk" class="form-control" placeholder="Tanggal Masuk" value="<?php echo $data['tglmasuk']; ?>" required/>
                                <script>
                                    $('#tglmasuk').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibraryL: 'fontawesome',
                                        format: 'yyyy-mm-dd'
                                    });
                                </script>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <select class="form-control" id="jk" name="jk">
                                <option value="1" <?php if($data['jk'] == 'L') { echo 'selected'; } ?>>Laki-Laki</option>
                                <option value="2" <?php if($data['jk'] == 'P') { echo 'selected'; } ?>>Perempuan</option>
                            </select>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="noktp" name="noktp" class="form-control" placeholder="Nomer KTP" value="<?php echo $data['noktp']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="tmptlahir" name="tmptlahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $data['tmptlahir']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input id="tgllahir" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo $data['tgllahir']; ?>" required/>
                                <script>
                                    $('#tgllahir').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibraryL: 'fontawesome',
                                        format: 'yyyy-mm-dd'
                                    });
                                </script>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="nokk" name="nokk" class="form-control" placeholder="Nomer Kartu Keluarga" value="<?php echo $data['nokk']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" value="<?php echo $data['alamat']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="nmibu" name="nmibu" class="form-control" placeholder="Nama Ibu Kandung" value="<?php echo $data['nmibu']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="npwp" name="npwp" class="form-control" placeholder="NPWP" value="<?php echo $data['npwp']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="bpjstk" name="bpjstk" class="form-control" placeholder="BPJS Ketenagakerjaan" value="<?php echo $data['bpjstk']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="bpjspen" name="bpjspen" class="form-control" placeholder="BPJS Pensiun" value="<?php echo $data['bpjspensi']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="bpjskes" name="bpjskes" class="form-control" placeholder="BPJS Kesehatan" value="<?php echo $data['bpjskes']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="norek" name="norek" class="form-control" placeholder="Nomer Rekening" value="<?php echo $data['norek']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="notelp" name="notelp" class="form-control" placeholder="Nomer Telepon/HP" value="<?php echo $data['notelp']; ?>" required>
                        </div>
                        <br>

                        <hr>
                        <button class="btn btn-success btn-block" type="submit" name="submit">Simpan</button>
                        <a class="btn btn-danger btn-block" href="../data_karyawan.php" role="button"> Kembali </a>

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