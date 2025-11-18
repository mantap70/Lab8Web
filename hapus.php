<?php
// KONEKSI
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

// -----------------------------------------
// MODE 1 → FORM INPUT ID BARANG
// -----------------------------------------
if (!isset($_POST['hapus'])) {
?>
    <h2>Hapus Barang Berdasarkan ID</h2>
    <form method="POST" action="">
        <label>ID Barang:</label>
        <input type="number" name="id_barang" required>
        <button type="submit" name="hapus">Hapus</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Index</a>
<?php
    exit;
}

// -----------------------------------------
// MODE 2 → PROSES HAPUS
// -----------------------------------------
$id = $_POST['id_barang'];

$sql = "DELETE FROM data_barang WHERE id_barang = '$id'";

if (mysqli_query($conn, $sql)) {
    echo "Barang dengan ID $id berhasil dihapus!<br>";
    echo "<a href='index.php'>Kembali ke Index</a>";
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>
