<?php
include 'koneksi.php';

$keterangan = htmlspecialchars ($_POST['ket']);
if (preg_match('/[^a-zA-Z0-9\s&]/', $keterangan)) {
    die("MAU NGAPAINN?????SORRYYYYYYY YEEEEEEEEEEEEE!!!!!!!!!!!!!!");
} else {
$tanggal = htmlspecialchars ($_POST['tanggal']);
$keterangan = htmlspecialchars ($_POST['ket']);
$nominal = htmlspecialchars( $_POST['nominal']);
$kategori_id = htmlspecialchars ($_POST['kategori_id']);
$jenis_transaksi = htmlspecialchars ($_POST['jenis_transaksi']);
}

if (empty($keterangan) || !is_numeric($nominal)) {
    die("Data tidak valid! Pastikan keterangan diisi dan nominal berupa angka.");
}
$sql = "INSERT INTO transaksi (tgl, jenis_transaksi, keterangan, nominal, id_kategori) 
        VALUES (?, ?, ?, ?, ?)";
$params = array($tanggal, $jenis_transaksi, $keterangan, $nominal, $kategori_id);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Transaksi berhasil disimpan!";
}

sqlsrv_close($conn);
?>