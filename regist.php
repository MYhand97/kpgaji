<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</head>
<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 mx-auto">
                <div class="card card-signin flex-row my-5">
                    <div class="card-body">
                        <img class="mb-3" src="assets/bootstrap4/site/docs/4.4/assets/img/favicons/android-chrome-512x512.png" alt="" width="72" height="72">
                        <h5 class="card-title text-center">Daftar</h5>
                        <form class="form-signin" action="cek_regist.php" method="POST">
                            <div class="form-label-group">
                                <input type="text" id="nik" name="nik" class="form-control" placeholder="N I K" required autofocus>
                            </div>
                            <br>

                            <div class="form-label-group">
                                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                            <br>

                            <div class="form-label-group">
                                <input type="password" id="pswrd" name="pswrd" class="form-control" placeholder="Password" required>
                            </div>
                            <br>
              
                            <div class="form-label-group">
                                <input type="password" id="rpswrd" name="rpswrd" class="form-control" placeholder="Re-Password" required>
                            </div>
                            
                            <?php
                            if(isset($_SESSION['errorMessage'])){
                                $error = $_SESSION['errorMessage'];
                                echo '<br>';
                                echo '<span style="color:red">'.$error.'</span>';
                            }
                            else if(isset($_SESSION['Message'])){
                                $msg = $_SESSION['Message'];
                                echo '<br>';
                                echo '<span style="color:green">'.$msg.'</span>';
                            }
                            ?>
              
                            <hr>
                            <button class="btn btn-primary btn-block" type="submit">Daftar</button>
                            <a class="btn btn-secondary btn-block" href="./" role="button"> Kembali </a>

                        </form>
                        
                        <hr>
                            Sudah Memiliki akun?<a href="login.php"> masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>
<?php
    unset($_SESSION['errorMessage']);
    unset($_SESSION['Message']);
?>