<?php
include 'koneksi.php';

$id_transaksi = intval($_POST['id_transaksi']);
$tanggal = htmlspecialchars($_POST['tanggal']);
$keterangan = htmlspecialchars($_POST['ket']);
$nominal = htmlspecialchars($_POST['nominal']);
$kategori_id = intval($_POST['kategori_id']);
$jenis_transaksi = htmlspecialchars($_POST['jenis_transaksi']);

// Validasi
if (empty($keterangan) || !is_numeric($nominal)) {
    die("Data tidak valid! Pastikan keterangan diisi dan nominal berupa angka.");
}

$sql = "UPDATE transaksi SET tgl = ?, jenis_transaksi = ?, keterangan = ?, nominal = ?, id_kategori = ? WHERE id_transaksi = ?";
$params = array($tanggal, $jenis_transaksi, $keterangan, $nominal, $kategori_id, $id_transaksi);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Transaksi berhasil diperbarui!";
}

sqlsrv_close($conn);
header("Location: index.php");
exit();
?>
