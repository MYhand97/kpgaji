<?php

session_start();

include 'koneksi.php';

if(isset($_POST['nik'])){
    
    $nik = $_POST['nik'];
    $password = md5($_POST['pswrd']);
    $error="nik/password salah";
    $login = mysqli_query($conn, "select * from users where nik='$nik' and pswrd='$password'");
    $info = mysqli_query($conn, "select * from dtkaryawan where nik='$nik'");
    $cek = mysqli_num_rows($login);
    if($cek > 0){

        $infodata = mysqli_fetch_array($info);
        $data = mysqli_fetch_array($login);
    
        if($data['level']=="admin"){
            $_SESSION['id'] = $data['id'];
            $_SESSION['nik'] = $nik;
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = "admin";
    
            header("location:admin/dashboard.php");
        }
        else if($data['level']=="karyawan"){
            $_SESSION['id'] = $data['id'];
            $_SESSION['nik'] = $nik;
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = "karyawan";
            $_SESSION['jabatan'] = $infodata['jabatan'];
            $_SESSION['bagian'] = $infodata['bagian'];
    
            header("location:karyawan/dashboard.php");
        }
        else if($data['level']=="owner"){
            $_SESSION['id'] = $data['id'];
            $_SESSION['nik'] = $nik;
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['level'] = "owner";
    
            header("location:owner/dashboard.php");
        }
    }
    else{
        $_SESSION['errorMessage'] = $error;
        header("location:login.php");
    }
}
else{
    $_SESSION['errorMessage'] = $error;
    header("location:login.php");
}
?>