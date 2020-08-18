<?php 
include '../../koneksi.php';
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
                    <a class="nav-link" href="../pinjaman.php">Pengajuan Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../gaji.php">Lihat Gaji</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php
                session_start();
                if($_SESSION['level']=="" || $_SESSION['level'] != "karyawan"){
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
                <h1 class="display-3">Gaji Karyawan</h1>
            </div>
        </div>

        <div class="container">
            <div class="card card-signin">
                <div class="card-body">
                    <h5 class="card-title text-center">Detail Gaji</h5>

                    <?php
                    if(isset($_GET['id'])){
                        $id=$_GET['id'];
                        $select = mysqli_query($conn, "select * from tbgaji where id='$id'") or die(mysqli_error($conn));
                        if(mysqli_num_rows($select) == 0){
                            echo '<div class="alert alert-warning">ID tidak ada dalam database.</div>';
				            exit();
			                //jika hasil query > 0
			            }else{
				            //membuat variabel $data dan menyimpan data row dari query
                            $data = mysqli_fetch_assoc($select);
                            $gkotor = 0;
                            $gkotor = $data['gajipokok']+$data['uanglembur'];
                            // DEDUCTION
                            $deduction = 0;
                            $deduction = $data['pph']+$data['pinjaman']+$data['bpjstk']+$data['bpjspen']+$data['bpjskes'];
                            // GAJI BERSIH
                            $gbersih = 0;
                            $gbersih = $gkotor-$deduction;
			            }
                    }
                    ?>
                    
                    <?php
                    if(isset($_POST['submit'])){
                        require '../../vendor/autoload.php';
                        // POST FORM
                        $no = 1;
                        $periode = $_POST['periode'];
                        $nik = $_POST['nik'];
                        $nama = $_POST['nama'];
                        $jabatan = $_POST['jabatan'];
                        $bagian = $_POST['bagian'];
                        $jmlmasuk = $_POST['jmlmasuk'];
                        $gaji = "Rp " . number_format($data['gajipokok'],2,',','.');
                        $jmllembur = $_POST['jmllembur'];
                        $lembur = "Rp " . number_format($data['uanglembur'],2,',','.');
                        $pph = "Rp " . number_format($data['pph'],2,',','.');
                        $bpjstk = "Rp " . number_format($data['bpjstk'],2,',','.');
                        $bpjspen = "Rp " . number_format($data['bpjspen'],2,',','.');
                        $bpjskes = "Rp " . number_format($data['bpjskes'],2,',','.');
                        $pinjaman = "Rp " . number_format($data['pinjaman'],2,',','.');
                        $potong = "Rp " . number_format($deduction,2,',','.');
                        $dapet = "Rp " . number_format($gkotor,2,',','.');
                        $takehome = "Rp " . number_format($gbersih,2,',','.');
                        $tgl = date("d-m-Y", strtotime($data['tglup']));

                        // Create new PDF Instance
                        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L']);

                        // Create PDF
                        $data = '';
                        $data .= '
                        <style>
                        table {
                            border-collapse: collapse;
                        }
                        table, th, td { border: 0px solid black; } </style>
                        <caption><h3>SLIP GAJI PT. Solutama Mutiara Lestari - User : PT. Torabika Eka Semesta - Ground 2</h3></caption>
                        <hr>
                        <table rules="all" width="100%">
                        <tr>
                            <td colspan="3">No Urut | '.$no.' </td>
                            <td colspan="3" rowspan="2">Periode | '.$periode.'</td>
                        </tr>
                        <tr>
                            <td colspan="3">Nama | '.$nama.'</td>
                            
                        </tr>
                        <tr>
                            <td colspan="6">NIK/Bagian|'.$nik.'|'.$jabatan.'-'.$bagian.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <th colspan="3">INCOME</th>
                            <th colspan="3">DEDUCTION</th>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="1">Gaji Pokok</td>
                            <td colspan="1">: '.$jmlmasuk.'HR :</td>
                            <td colspan="1">'.$gaji.'</td>
                            <td colspan="2">PPH :</td>
                            <td colspan="1">'.$pph.'</td>
                        </tr>
                        <tr>
                            <td colspan="1">Total Lembur</td>
                            <td colspan="1">: '.$jmllembur.'HK :</td>
                            <td colspan="1">'.$lembur.'</td>
                            <td colspan="1">BPJS-Ketenagakerjaan</td>
                            <td colspan="1">: 2% :</td>
                            <td colspan="1">'.$bpjstk.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1">Jaminan Pensiun</td>
                            <td colspan="1">: 1% :</td>
                            <td colspan="1">'.$bpjspen.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="1">BPJS-Kesehatan</td>
                            <td colspan="1">: 1% :</td>
                            <td colspan="1">'.$bpjskes.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">Pinjaman :</td>
                            <td colspan="1">'.$pinjaman.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="2">Total Income</td>
                            <td colspan="1">'.$dapet.'</td>
                            <td colspan="2">Total Deduction</td>
                            <td colspan="1">'.$potong.'</td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <th colspan="3" rowspan="2">Take Home Pay</th>
                            <th colspan="3" rowspan="2">'.$takehome.'</th>
                        </tr>
                    </table>
                    <br><hr><br>
                    <table border="0" width="100%">
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <th colspan="6">Tangerang, '.$tgl.'</th>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <th colspan="3">( Dibuat Oleh )</th>
                            <th colspan="3">( Diterima )</th>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <br> </td>
                            <td colspan="3"> <br> </td>
                        </tr>
                        <tr>
                            <th colspan="3">( Payroll )</th>
                            <th colspan="3">( '.$nama.' )</th>
                        </tr>
                    </table>';
                        $data .= '';

                        // Write PDF
                        $mpdf->WriteHTML($data);

                        // Output to browser
                        $mpdf->Output('SlipGaji.pdf', 'D');
                    }
                    ?>

                    <br>
                    <form class="form-signin" action="lihat_gaji.php?id=<?php echo $id; ?>" method="POST">
                        <div class="form-label-group">
                            <label class="form-check-label" for="periode">Periode</label>
                            <input readonly type="text" id="periode" name="periode" class="form-control" placeholder="Periode" value="<?php echo $data['periode']; ?>" required>
                        </div>
                        <br>
                        
                        <div class="form-label-group">
                            <label class="form-check-label" for="nik">Nomor Induk Karyawan</label>
                            <input readonly type="text" id="nik" name="nik" class="form-control" placeholder="N I K" value="<?php echo $data['nik']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="nama">Nama Karyawan</label>
                            <input readonly type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo $data['nama']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="jabatan">Jabatan</label>
                            <input readonly type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Jumlah Masuk (Hari)" value="<?php echo $data['jabatan']; ?>" required>
                        </div>
                        <br>
                            
                        <div class="form-label-group">
                            <label class="form-check-label" for="bagian">Bagian</label>
                            <input readonly type="text" id="bagian" name="bagian" class="form-control" placeholder="Jumlah Masuk (Hari)" value="<?php echo $data['bagian']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="jmlmasuk">Jumlah Masuk</label>
                            <input readonly type="text" id="jmlmasuk" name="jmlmasuk" class="form-control" placeholder="Jumlah Masuk (Hari)" value="<?php echo $data['jmlmasuk']; ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="gaji">Gaji</label>
                            <input readonly type="text" id="gaji" name="gaji" class="form-control" placeholder="Gaji" value="<?php echo "Rp " . number_format($data['gajipokok'],2,',','.'); ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="jmllembur">Jumlah Lembur</label>
                            <input readonly type="text" id="jmllembur" name="jmllembur" class="form-control" placeholder="Jumlah Lembur (Jam)" value="<?php echo $data['jmllembur']; ?>">
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="lembur">Uang Lembur</label>
                            <input readonly type="text" id="lembur" name="lembur" class="form-control" placeholder="Uang Lembur" value="<?php echo "Rp " . number_format($data['uanglembur'],2,',','.'); ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="gkotor">Gaji Kotor</label>
                            <input readonly type="text" id="gkotor" name="gkotor" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($gkotor,2,',','.'); ?>" required>
                        </div>
                        
                        <hr>

                        <div class="form-label-group">
                            <label class="form-check-label" for="bpjstk">BPJS Tenaga Kerja</label>
                            <input readonly type="text" id="bpjstk" name="bpjstk" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($data['bpjstk'],2,',','.'); ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="bpjspen">BPJS Jaminan Pensiun</label>
                            <input readonly type="text" id="bpjspen" name="bpjspen" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($data['bpjspen'],2,',','.'); ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="bpjskes">BPJS Kesehatan</label>
                            <input readonly type="text" id="bpjskes" name="bpjskes" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($data['bpjskes'],2,',','.'); ?>" required>
                        </div>
                        <br>
                        
                        <div class="form-label-group">
                            <label class="form-check-label" for="pph">Pph</label>
                            <input readonly type="text" id="pph" name="pph" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($data['pph'],2,',','.'); ?>" required>
                        </div>
                        <br>

                        <div class="form-label-group">
                            <label class="form-check-label" for="pinjaman">Pinjaman</label>
                            <input readonly type="text" id="pinjaman" name="pinjaman" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($data['pinjaman'],2,',','.'); ?>" required>
                        </div>
                        <br>


                        <div class="form-label-group">
                            <label class="form-check-label" for="deduction">Deduction</label>
                            <input readonly type="text" id="deduction" name="deduction" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($deduction,2,',','.'); ?>" required>
                        </div>
                        <hr>

                        <div class="form-label-group">
                            <label class="form-check-label" for="gbersih">Gaji Bersih</label>
                            <input readonly type="text" id="gbersih" name="gbersih" class="form-control" placeholder="" value="<?php echo "Rp " . number_format($gbersih,2,',','.'); ?>" required>
                        </div>
              
                        <hr>
                        <button class="btn btn-success btn-block" type="submit" name="submit">Cetak Slip Gaji</button>
                        <a class="btn btn-danger btn-block" href="../gaji.php" role="button"> Kembali </a>

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