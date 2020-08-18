<?php
include '../../koneksi.php';
session_start();
if($_SESSION['level']=="" || $_SESSION['level'] != "admin"){
    echo '<script>alert("Ilegal URL"); document.location="../.././";</script>';
    session_destroy();
}
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = mysqli_query($conn, "select * from tbgaji where id='$id'") or die(mysqli_error($conn));
    if(mysqli_num_rows($query)){
        $del = mysqli_query($conn, "delete from tbgaji where id='$id'") or die(mysqli_error($conn));
        if($del){
            echo '<script>alert("Berhasil menghapus data."); document.location="../gajian.php";</script>';
		}else{
			echo '<script>alert("Gagal menghapus data."); document.location="../gajian.php";</script>';
		}
	}else{
		echo '<script>alert("ID tidak ditemukan di database."); document.location="../gajian.php";</script>';
	}
}
else{
	echo '<script>alert("ID tidak ditemukan di database."); document.location="../gajian.php";</script>';
}
?>