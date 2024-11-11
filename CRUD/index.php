<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function loadData() {
            fetch("get_data_transaksi.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("dataTable").innerHTML = data;
                });
        }
    
        function submitForm(event) {
            event.preventDefault();
            const formData = new FormData(document.getElementById("transaksiForm"));

            fetch("simpan_transaksi.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                document.getElementById("transaksiForm").reset();
                loadData(); // Memperbarui data setelah menyimpan transaksi baru
            });
        }

        // Muat data saat halaman selesai dimuat
        window.onload = loadData;
    </script>
</head>
<body>

<h2>Data Transaksi</h2> 
<table border="1">
    <thead>
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Jenis Transaksi</th>
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="dataTable">
        <!-- Data transaksi -->
    </tbody>
</table>

<h2>Tambah Transaksi Baru</h2>
<form id="transaksiForm" onsubmit="submitForm(event)">
    <label>Tanggal: <input type="date" name="tanggal" required></label><br>
    <label>Keterangan: <input type="text" name="ket" required></label><br>
    <label>Nominal: <input type="number" name="nominal"></label><br>
    <label>Jenis Transaksi: 
        <select name="jenis_transaksi" required>
            <option value="Debit">Debit</option>
            <option value="Kredit">Kredit</option>
        </select>
    </label><br>
    <label>Kategori: 
        <select name="kategori_id" required>
            <?php 
            include 'get_kategori.php'; 
            ?>
        </select>
        <a href="olah_kategori.php">Tambah Kategori Baru</a>
    </label><br>
    <input type="submit" value="Simpan Transaksi">
</form>

</body>
</html>
