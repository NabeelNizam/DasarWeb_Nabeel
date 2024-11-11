<?php
include 'koneksi.php';

$sql_transaksi = "SELECT t.id_transaksi, t.tgl, t.jenis_transaksi, t.keterangan, t.nominal, k.nama_kategori, k.id_kategori
                  FROM transaksi t 
                  JOIN kategori k ON t.id_kategori = k.id_kategori";
$result_transaksi = sqlsrv_query($conn, $sql_transaksi);

if ($result_transaksi === false) {
    die(print_r(sqlsrv_errors(), true));
}

$counter = 1; 
while($row = sqlsrv_fetch_array($result_transaksi, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>{$counter}</td>";
    echo "<td>" . $row['tgl']->format('d-m-Y') . "</td>";
    echo "<td>{$row['jenis_transaksi']}</td>";
    echo "<td>{$row['keterangan']}</td>";
    echo "<td>" . number_format($row['nominal'], 0, ',', '.') . " IDR</td>";
    echo "<td>{$row['nama_kategori']}</td>";
    echo "<td>
        <a href='hapus_transaksi.php?id={$row['id_transaksi']}' onclick=\"return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');\" style='color: red;'>Hapus</a>
        <a href='update_data.php?id_transaksi={$row['id_transaksi']}'>Edit</a>
      </td>";
    echo "</tr>";
    $counter++; 
}

sqlsrv_close($conn);
?>
