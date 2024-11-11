<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_transaksi = intval($_GET['id']); 

    $sql = "DELETE FROM transaksi WHERE id_transaksi = ?";
    $params = array($id_transaksi);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Transaksi berhasil dihapus!";
    }

    sqlsrv_close($conn);

    header("Location: index.php");
    exit(); 
} else {
    echo "ID transaksi tidak ditentukan.";
}
?>
