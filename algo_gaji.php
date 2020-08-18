<?php
// Base Algo Gaji
$harian = 146966.07;
$lembur = 25500;
$bpjs_tk = 4409000*0.02;
$bpjs_pen = 4409000*0.01;
$bpjs_kes = 4409000*0.01;
$pph21;
$deduction = $bpjs_kes+$bpjs_pen+$bpjs_tk+$pph21;

// Var Input
$jmlMasuk;
$jmlLembur;
$pinjam;

// Penggajian
$bulanan = $jmlMasuk*$harian;
$tLembur = $jmlLembur*$lembur;
$gKotor = $bulanan*$tLembur;
$gBersih = $gKotor-$deduction;
?>