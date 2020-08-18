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
                    <a class="nav-link" href="pinjaman.php">Pengajuan Pinjaman</a>
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
                <h1 class="display-3">Ubah Password User</h1>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Data User</h5>
                    <?php
                    if(isset($_GET['id'])){
                        $id=$_GET['id'];
                        $select = mysqli_query($conn, "select * from users where id='$id'") or die(mysqli_error($conn));
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
                        $nik = $_POST['nik'];
                        $nama = $_POST['nama'];
                        $pass = md5($_POST['pswrd']);
                        $npass = md5($_POST['npswrd']);
                        $rpass = md5($_POST['rpswrd']);
                        if($pass == $data['pswrd']){
                            if($npass == $rpass){
                                $query = mysqli_query($conn, "update users set nik='$nik', pswrd='$npass', nama='$nama' where id='$id'");
                                if($query){
                                    echo '<script>alert("Berhasil ubah data user"); document.location="dashboard.php";</script>';
                                }
                                else{
                                    echo '<div class="alert alert-warning">Password dan Confirm Password salah</div>';
                                }
                            }
                            else{
                                echo '<div class="alert alert-warning">Password dan Confirm Password salah</div>';
                            }
                        }
                        else{
                            echo '<div class="alert alert-warning">Old Password Salah</div>';
                        }
                    }
                    ?>
                    <br>
                    <form class="form-signin" action="user.php?id=<?php echo $id; ?>" method="POST">
                        <div class="form-label-group">
                            <input readonly type="text" id="nik" name="nik" class="form-control" value="<?php echo $data['nik']; ?>" required autofocus>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input readonly type="text" id="nama" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="password" id="pswrd" name="pswrd" class="form-control" placeholder="Old Password" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <input type="password" id="npswrd" name="npswrd" class="form-control" placeholder="New Password" required>
                        </div>
                        <br>
              
                        <div class="form-label-group">
                            <input type="password" id="rpswrd" name="rpswrd" class="form-control" placeholder="Confirm Password" required>
                        </div>
              
                        <hr>
                        <button class="btn btn-success btn-block" type="submit" name="submit">Buat PDF</button>
                        <a class="btn btn-danger btn-block" href="./dashboard.php" role="button"> Kembali </a>

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
