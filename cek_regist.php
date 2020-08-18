<?php
session_start();
include 'koneksi.php';

if(isset($_POST['nik'])){
    $nik=$_POST['nik'];
    $nama=$_POST['nama'];
    $pswrd=md5($_POST['pswrd']);
    $level="karyawan";
    $error="Password dan Confirm Password tidak sama";
    if($_POST['pswrd'] === $_POST['rpswrd']){
        
        $regist=mysqli_query($conn, "insert into users(id,nik,pswrd,nama,level) values ('','$nik','$pswrd','$nama','$level')");
        if($regist){
            $_SESSION['Message']="Daftar berhasil!";
            header("location:regist.php");
        }
        else{
            $_SESSION['errorMessage']="NIK tidak tersedia atau sudah terdaftar";
            header("location:regist.php");
        }
    }
    else{
        $_SESSION['errorMessage'] = $error;
        header("location:regist.php");
    }
}
else{
    $_SESSION['errorMessage'] = $error;
        header("location:regist.php");
}

?>