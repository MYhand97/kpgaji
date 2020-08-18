<?php
include '../../koneksi.php';
if(isset($_POST['submit'])){
    require '../../vendor/autoload.php';
    $periode = $_POST['periode'];
    $select = mysqli_query($conn, "select * from tbgaji where periode='$periode'") or die(mysqli_error($conn));
    if(mysqli_num_rows($select) == 0){
        echo '<div class="alert alert-warning">Periode tidak ada dalam database.</div>';
        exit;
        //jika hasil query > 0
    }
    else{
        //membuat variabel $data dan menyimpan data row dari query
        $no = 1;
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4-L', 'tempDir' => 'tmp']);
        while($data = mysqli_fetch_array($select)){
            $gkotor = 0;
            $gkotor = $data['gajipokok']+$data['uanglembur'];
            // DEDUCTION
            $deduction = 0;
            $deduction = $data['pph']+$data['pinjaman']+$data['bpjstk']+$data['bpjspen']+$data['bpjskes'];
            // GAJI BERSIH
            $gbersih = 0;
            $gbersih = $gkotor-$deduction;
            $periode = $data['periode'];
            $nik = $data['nik'];
            $nama = $data['nama'];
            $jabatan = $data['jabatan'];
            $bagian = $data['bagian'];
            $jmlmasuk = $data['jmlmasuk'];
            $gaji = "Rp " . number_format($data['gajipokok'],2,',','.');
            $jmllembur = $data['jmllembur'];
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
            // Create PDF
            $html = '';
            $html .= '
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
                <td colspan="1">Gaji Pokok :</td>
                <td colspan="1">'.$jmlmasuk.'HR :</td>
                <td colspan="1">'.$gaji.'</td>
                <td colspan="2">PPH :</td>
                <td colspan="1">'.$pph.'</td>
            </tr>
            <tr>
                <td colspan="1">Total Lembur :</td>
                <td colspan="1">'.$jmllembur.'HK :</td>
                <td colspan="1">'.$lembur.'</td>
                <td colspan="1">BPJS-Ketenagakerjaan :</td>
                <td colspan="1">2% :</td>
                <td colspan="1">'.$bpjstk.'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="1">Jaminan Pensiun :</td>
                <td colspan="1">1% :</td>
                <td colspan="1">'.$bpjspen.'</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="1">BPJS-Kesehatan :</td>
                <td colspan="1">1% :</td>
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
            $html .= '';

            // Write PDF
            $mpdf->WriteHTML($html);
            $no++;
        }
    }
    $mpdf->Output('Laporan.pdf', 'D');
    exit;
}
?>