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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/fontawesome/css/all.css" rel="stylesheet">
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
                    <a class="nav-link active" href="pinjaman.php">Pengajuan Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="gaji.php">Lihat Gaji</a>
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
                <h1 class="display-3">Pengajuan Pinjaman</h1>
            </div>
        </div>

        <div class="container">
            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Pengajuan Pinjaman</h5>
                    <br>
                    <form class="form-signin" action="buat_pdf.php" method="POST">
                        <div class="form-label-group">
                            <input readonly type="text" id="nik" name="nik" class="form-control" value="<?php echo $_SESSION['nik']; ?>" required autofocus>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input readonly type="text" id="nama" name="nama" class="form-control" value="<?php echo $_SESSION['nama']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                        <?php
                        if($_SESSION['jabatan'] == ""){
                            echo '<select class="form-control" id="jabatan" name="jabatan">';
                            $query=mysqli_query($conn, "select jbtan, COUNT(*) as j from jabatan GROUP BY jbtan HAVING j>=1 ORDER BY j asc");
                            while($row=mysqli_fetch_array($query)){
                                echo '<option value="'.$row['jbtan'].'">'.$row['jbtan']."</option>";
                            }
                            echo '</select>';
                        }
                        else{
                            echo '<select class="form-control" id="jbtanList" name="jbtanList" disabled>';
                            echo '<option value="'.$_SESSION['jabatan'].'">'.$_SESSION['jabatan'].'</option>';
                            echo '</select>';
                            echo '<input type="hidden" name="jabatan" value="'.$_SESSION['jabatan'].'"/>';
                        }
                        ?>
                        </div>
                        <br>

                        <div class="form-label-group">
                        <?php
                        if($_SESSION['bagian'] == ""){
                            echo '<select class="form-control" id="bagian" name="bagian">';
                            $query=mysqli_query($conn, "SELECT bagian FROM jabatan ORDER by jbtan ASC");
                            while($row=mysqli_fetch_array($query)){
                                echo '<option value="'.$row['bagian'].'">'.$row['bagian']."</option>";
                            }
                            echo '</select>';
                        }
                        else{
                            echo '<select class="form-control" id="bgianList" name="bgianList" disabled>';
                            echo '<option value="'.$_SESSION['bagian'].'">'.$_SESSION['bagian'].'</option>';
                            echo '</select>';
                            echo '<input type="hidden" name="bagian" value="'.$_SESSION['bagian'].'"/>';
                        }
                        ?>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="pinjam" name="pinjam" class="form-control" placeholder="Jumlah Pinjaman" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="Txtpinjam" name="Txtpinjam" class="form-control" placeholder="Jumlah Pinjaman Terbilang" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="kperluan" name="kperluan" class="form-control" placeholder="Keperluan" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="text" id="waktu" name="waktu" class="form-control" placeholder="Jangka Waktu (X hari/minggu/bulan)" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input id="tglpinjam" name="tglpinjam" class="form-control" placeholder="Tanggal Penyerahan" required/>
                                <script>
                                    $('#tglpinjam').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibraryL: 'fontawesome',
                                        format: 'yyyy-mm-dd'
                                    });
                                </script>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input id="tglbalik" name="tglbalik" class="form-control" placeholder="Tanggal Pengembalian" required/>
                                <script>
                                    $('#tglbalik').datepicker({
                                        uiLibrary: 'bootstrap4',
                                        iconsLibraryL: 'fontawesome',
                                        format: 'yyyy-mm-dd'
                                    });
                                </script>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <select class="form-control" id="carabalik" name="carabalik">
                                <option value="">Cara Pengembalian</option>
                                <option value="1">Tunai</option>
                                <option value="2">Transfer</option>
                                <option value="3">Potong Gaji</option>
                            </select>
                        </div>
              
                        <hr>
                        <button class="btn btn-success btn-block" type="submit">Buat PDF</button>
                        <a class="btn btn-danger btn-block" href="./" role="button"> Kembali </a>

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

<?php
    unset($_SESSION['errorMessage']);
    unset($_SESSION['Message']);
?>