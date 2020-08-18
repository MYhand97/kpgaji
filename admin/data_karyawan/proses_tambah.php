<?php
include '../../koneksi.php';
session_start();
if($_SESSION['level']=="" || $_SESSION['level'] != "admin"){
    echo '<script>alert("Ilegal URL"); document.location="../.././";</script>';
    session_destroy();
}

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

if(isset($_POST['nik'])){
    $query=mysqli_query($conn, "INSERT INTO dtkaryawan(id, nik, nama, jabatan, bagian, tglmasuk, jk, noktp, tmptlahir, tgllahir, nokk, alamat, nmibu, npwp, bpjstk, bpjspensi, bpjskes, norek, notelp) 
    VALUES (NULL,'$nik','$nama','$jbtan','$bagian','$tglMasuk','$jk','$nktp','$tmptLahir','$tglLahir','$nkk','$alamat','$nmibu','$npwp','$bpjstk','$bpjspen','$bpjskes','$norek','$notelp')");
    if($query){
        $_SESSION['Message']="Daftar berhasil!";
        header("location:tambah_karyawan.php");
    }
    else{
        $_SESSION['errorMessage']="Ada yang salah, mohon periksa lagi";
        header("location:tambah_karyawan.php");
    }
}
else{
    $_SESSION['errorMessage']="Ada yang salah, mohon periksa lagi";
    header("location:tambah_karyawan.php");
}
?>