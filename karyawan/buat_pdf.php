<?php
require '../vendor/autoload.php';
session_start();
if($_SESSION['level']=="" || $_SESSION['level'] != "karyawan"){
    echo '<script>alert("Ilegal URL"); document.location=".././";</script>';
}
//GET Variables
$fnik = $_POST['nik'];
$fnama = $_POST['nama'];
$fjabatan = $_POST['jabatan'];
$fbagian = $_POST['bgian'];
$fpinjam = $_POST['pinjam'];
$pinjam = "Rp " . number_format($fpinjam,2,',','.');
$ftxtPinjam = $_POST['Txtpinjam'];
$fkperluan = $_POST['kperluan'];
$fwaktu = $_POST['waktu'];
$ftglpinjam = $_POST['tglpinjam'];
$ftglbalik = $_POST['tglbalik'];
$fcarabalik = $_POST['carabalik'];
if($fcarabalik == 1){
    $cara = "Tunai";
}
else if($fcarabalik == 2){
    $cara = "Transfer";
}
else if($fcarabalik == 3){
    $cara = "Potong Gaji";
}
else{
    $cara = "Kok Kosong Ya Assu";
}

// Create new PDF Instance
$mpdf = new \Mpdf\Mpdf();

// Create PDF
$data = '';

$data .= '<style> h3{text-align: center;} </style> <h3> PERMOHONAN PEMINJAMAN UANG </h3><br>';
$data .= '<p> Saya yang bertanda tangan di bawah ini : </p>';
$data .= '
<table style="width:65%">
    <tr>
        <td>Nama Lengkap</td>
        <td>:</td>
        <td>'.$fnama.'</td>
    </tr>
    <tr>
        <td>Nomor Induk Karyawan</td>
        <td>:</td>
        <td>'.$fnik.'</td>
    </tr>
    <tr>
        <td>Jabatan Karyawan</td>
        <td>:</td>
        <td>'.$fjabatan.'</td>
    </tr>
    <tr>
        <td>Bagian Penempatan</td>
        <td>:</td>
        <td>'.$fbagian.'</td>
    </tr>
</table> <br \>';
$data .= '<p> Dengan ini mengajukan permohonan peminjaman uang kepada Perusahaan sebagai berikut : </p>';
$data .= '
<table style="width:65%">
    <tr>
        <td>Besarnya Pinjaman</td>
        <td>:</td>
        <td>'.$pinjam.'</td>
    </tr>
    <tr>
        <td>Besarnya Pinjaman Terbilang</td>
        <td>:</td>
        <td>'.$ftxtPinjam.'</td>
    </tr>
    <tr>
        <td>Keperluan</td>
        <td>:</td>
        <td>'.$fkperluan.'</td>
    </tr>
    <tr>
        <td>Jangka Waktu Pengembalian</td>
        <td>:</td>
        <td>'.$fwaktu.'</td>
    </tr>
    <tr>
        <td>Tanggal Penyerahan Pinjaman</td>
        <td>:</td>
        <td>'.$ftglpinjam.'</td>
    </tr>
    <tr>
        <td>Tanggal Jatuh Tempo Pelunasan</td>
        <td>:</td>
        <td>'.$ftglbalik.'</td>
    </tr>
    <tr>
        <td>Cara Pengembalian</td>
        <td>:</td>
        <td>'.$cara.'</td>
    </tr>
</table> <br \>';
$data .= '<p>Demikian permohonan ini saya ajukan.</p>';
$data .= '<p>'.date("l d-m-Y").'</p>';
$data .= '<br>';
$data .= '<p>Menyetujui, </p>';
$data .= '
<style> th{text-align: center;} </style> 
<table style="width:65%">
    <tr>
        <th>Atasan</th>
        <th>HRD</th>
        <th>Karyawan</th>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
    </tr>
    <tr>
        <td>_____________________________</td>
        <td>_____________________________</td>
        <td>_____________________________</td>
    </tr>
</table> <br \>';

// Write PDF
$mpdf->WriteHTML($data);

// Output to browser
$mpdf->Output('peminjamanUang.pdf', 'D');

?>