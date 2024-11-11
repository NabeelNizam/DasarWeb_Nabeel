<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = $_POST['nama_kategori'];
    if (empty($nama_kategori) || preg_match('/[^a-zA-Z0-9\s&]/', $nama_kategori)) {
        die("MAU NGAPAINN?????SORRYYYYYYY YEEEEEEEEEEEEE!!!!!!!!!!!!!!");
    }
    $sql = "INSERT INTO kategori (nama_kategori) VALUES (?)";
    $params = array($nama_kategori);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        sqlsrv_close($conn);
        header("Location: index.php");
        exit(); 
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style-olah_kategori.css">
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
</head>
<body>
<h2>Tambah Kategori Baru</h2>
<form action="olah_kategori.php" method="post">
    <label>Nama Kategori: <input type="text" name="nama_kategori" required></label><br>
    <input type="submit" value="Tambah Kategori">
</form>
</body>
</html>
