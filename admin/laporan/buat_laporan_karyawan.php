<?php
session_start();
if($_SESSION['level']=="" || $_SESSION['level'] != "admin"){
    echo '<script>alert("Ilegal URL"); document.location="../.././";</script>';
    session_destroy();
}
include '../../koneksi.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Karyawan.xls");
?>
<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    } 

    th,td {
        border: 1px solid black;
    }
    h1,th {
        text-align: center;
    }
    td {
        text-align: left;
        }
    table.d {
        table-layout: fixed;
        width: 100%;  
    }
</style>
<h1>Data Karyawan<br/>PT.awokaowkaowkawok</h1>
<table class="d">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>NamaLengkap</th>
            <th>Jabatan</th>
            <th>Bagian</th>
            <th>Tanggal Masuk</th>
            <th>Jenis Kelamin</th>
            <th>Nomor KTP</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Nomor Kartu Keluarga</th>
            <th>Alamat</th>
            <th>Nama Ibu</th>
            <th>NPWP</th>
            <th>BPJS Ketenagakerjaan</th>
            <th>Jaminan Pensiun</th>
            <th>BPJS Kesehatan</th>
            <th>No Rek</th>
            <th>No Telp</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    $query = mysqli_query($conn, "select * from dtkaryawan");
    while($row = mysqli_fetch_array($query)){
        echo '<tr>';
        echo '<td>'.$no.'</td>';
        echo '<td>'.$row['nik'].'</td>';
        echo '<td>'.$row['nama'].'</td>';
        echo '<td>'.$row['jabatan'].'</td>';
        echo '<td>'.$row['bagian'].'</td>';
        echo '<td>'.$row['tglmasuk'].'</td>';
        echo '<td>'.$row['jk'].'</td>';
        echo '<td>'.$row['noktp'].'</td>';
        echo '<td>'.$row['tmptlahir'].'</td>';
        echo '<td>'.$row['tgllahir'].'</td>';
        echo '<td>'.$row['nokk'].'</td>';
        echo '<td>'.$row['alamat'].'</td>';
        echo '<td>'.$row['nmibu'].'</td>';
        echo '<td>'.$row['npwp'].'</td>';
        echo '<td>'.$row['bpjstk'].'</td>';
        echo '<td>'.$row['bpjspensi'].'</td>';
        echo '<td>'.$row['bpjskes'].'</td>';
        echo '<td>'.$row['norek'].'</td>';
        echo '<td>'.$row['notelp'].'</td>';
        $no++;
    }
    ?>
    </tbody>
</table>