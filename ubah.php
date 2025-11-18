<?php
// KONEKSI DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<?php
// -----------------------------------------------------------
// MODE 1 → TAMPILKAN FORM INPUT ID
// -----------------------------------------------------------
if (!isset($_POST['cari']) && !isset($_POST['update'])) {
?>
    <h2>Cari Barang Yang Akan Diubah</h2>
    <form method="POST" action="">
        <label>Masukkan ID Barang:</label><br>
        <input type="number" name="id_barang" required>
        <button type="submit" name="cari">Cari</button>
    </form>

    <br>
    <a href="index.php">Kembali ke Index</a>
<?php
    exit;
}

// -----------------------------------------------------------
// MODE 2 → SETELAH ID DIINPUT → TAMPILKAN FORM UBAH
// -----------------------------------------------------------
if (isset($_POST['cari'])) {

    $id = $_POST['id_barang'];
    $sql = "SELECT * FROM data_barang WHERE id_barang = '$id'";
    $result = mysqli_query($conn, $sql);

    if (!$result || mysqli_num_rows($result) == 0) {
        die("ERROR: Data tidak ditemukan! <br><br><a href='ubah.php'>Kembali</a>");
    }

    $data = mysqli_fetch_assoc($result);
?>

    <h2>Ubah Data Barang</h2>
    <form method="POST" action="">
        <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">

        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>"><br><br>

        <label>Kategori:</label><br>
        <input type="text" name="kategori" value="<?= $data['kategori'] ?>"><br><br>

        <label>Harga Jual:</label><br>
        <input type="number" name="harga_jual" value="<?= $data['harga_jual'] ?>"><br><br>

        <label>Harga Beli:</label><br>
        <input type="number" name="harga_beli" value="<?= $data['harga_beli'] ?>"><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?= $data['stok'] ?>"><br><br>

        <label>Gambar:</label><br>
        <input type="text" name="gambar" value="<?= $data['gambar'] ?>"><br><br>

        <button type="submit" name="update">Update Data</button>
    </form>

    <br>
    <a href="ubah.php">Cari Barang Lain</a> |
    <a href="index.php">Kembali ke Index</a>

<?php
    exit;
}

// -----------------------------------------------------------
// MODE 3 → UPDATE DATA KE DATABASE
// -----------------------------------------------------------
if (isset($_POST['update'])) {

    $id          = $_POST['id_barang'];
    $nama        = $_POST['nama'];
    $kategori    = $_POST['kategori'];
    $harga_jual  = $_POST['harga_jual'];
    $harga_beli  = $_POST['harga_beli'];
    $stok        = $_POST['stok'];
    $gambar      = $_POST['gambar'];

    $sql = "
        UPDATE data_barang SET
            nama = '$nama',
            kategori = '$kategori',
            harga_jual = '$harga_jual',
            harga_beli = '$harga_beli',
            stok = '$stok',
            gambar = '$gambar'
        WHERE id_barang = '$id'
    ";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diupdate!<br>";
        echo "<a href='index.php'>Kembali ke Index</a>";
    } else {
        echo "Gagal update: " . mysqli_error($conn);
    }
}
?>
