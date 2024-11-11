<?php
include 'koneksi.php';

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = intval($_GET['id_transaksi']);
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    $params = array($id_transaksi);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false || sqlsrv_has_rows($stmt) == false) {
        die("Data transaksi tidak ditemukan!");
    }
    $data = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style-update_data.css">
    <meta charset="UTF-8">
    <title>Edit Data Transaksi</title>
</head>
<body>
<h2>Edit Data Transaksi</h2>
<form action="proses_update.php" method="post">
    <input type="hidden" name="id_transaksi" value="<?php echo htmlspecialchars($data['id_transaksi']); ?>">
    <label>Tanggal: <input type="date" name="tanggal" value="<?php echo htmlspecialchars($data['tgl']->format('Y-m-d')); ?>" required></label><br>
    <label>Keterangan: <input type="text" name="ket" value="<?php echo htmlspecialchars($data['keterangan']); ?>" required></label><br>
    <label>Nominal: <input type="number" name="nominal" value="<?php echo htmlspecialchars($data['nominal']); ?>" required></label><br>
    <label>Jenis Transaksi: 
        <select name="jenis_transaksi" required>
            <option value="Debit" <?php if ($data['jenis_transaksi'] == 'Debit') echo 'selected'; ?>>Debit</option>
            <option value="Kredit" <?php if ($data['jenis_transaksi'] == 'Kredit') echo 'selected'; ?>>Kredit</option>
        </select>
    </label><br>
    <label>Kategori:
        <select name="kategori_id" required>
            <?php
            $sql_kategori = "SELECT * FROM kategori";
            $result_kategori = sqlsrv_query($conn, $sql_kategori);
            while($row = sqlsrv_fetch_array($result_kategori, SQLSRV_FETCH_ASSOC)) {
                $selected = $data['id_kategori'] == $row['id_kategori'] ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row['id_kategori']) . "' $selected>" . htmlspecialchars($row['nama_kategori']) . "</option>";
            }
            ?>
        </select>
    </label><br>
    <input type="submit" value="Update Transaksi">
</form>
</body>
</html>
