<?php
session_start();
include 'config/koneksi.php';
require('fpdf/fpdf.php');

// CEK LOGIN
if(!isset($_SESSION['login'])){
    echo "<script>
        alert('Anda harus login dulu!');
        window.location='login.php';
    </script>";
    exit;
}

// Ambil nama user
$id = $_SESSION['id_user'];
$q = mysqli_query($conn,"SELECT nama FROM users WHERE id_user='$id'");
$user = mysqli_fetch_array($q);

// Hitung total masuk
$q1 = mysqli_query($conn,"SELECT SUM(jumlah) AS total_masuk FROM kas_masuk");
$m = mysqli_fetch_array($q1);
$total_masuk = $m['total_masuk'] ?? 0;

// Hitung total keluar
$q2 = mysqli_query($conn,"SELECT SUM(jumlah) AS total_keluar FROM kas_keluar");
$k = mysqli_fetch_array($q2);
$total_keluar = $k['total_keluar'] ?? 0;

// Saldo akhir
$saldo = $total_masuk - $total_keluar;

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(0,10,'LAPORAN UANG KAS UKM ENGLISH CLUB',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,6,'PERIODE 2025/2026',0,1,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,'REKAP SALDO',0,1,'C');


$pdf->SetFont('Arial','',11);
$pdf->Cell(0,6,'Tanggal Cetak: '.date('d-m-Y'),0,1,'C');

$pdf->Ln(10);

$pdf->SetFont('Arial','B',11);

// TABEL REKAP
$pdf->Cell(70,10,'TOTAL KAS MASUK',1,0,'L');
$pdf->Cell(70,10,'Rp '.number_format($total_masuk,0,',','.'),1,1,'R');

$pdf->Cell(70,10,'TOTAL KAS KELUAR',1,0,'L');
$pdf->Cell(70,10,'Rp '.number_format($total_keluar,0,',','.'),1,1,'R');

$pdf->Cell(70,10,'SALDO AKHIR',1,0,'L');
$pdf->Cell(70,10,'Rp '.number_format($saldo,0,',','.'),1,1,'R');

// TTD
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);

$pdf->Cell(0,6,'Mengetahui,',0,1,'R');
$pdf->Cell(0,6,'Bendahara UKM',0,1,'R');

$pdf->Ln(15);
$pdf->Cell(0,6,'Anisa Febrianti',0,1,'R');

$pdf->Output();
?>
