<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Koneksi database
$conn = new mysqli('localhost', 'root', '', 'shoes');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil layanan dari database
$services = [];
$sql = "SELECT * FROM service";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelanggan = $_SESSION['user_id'];
    $id_service = $_POST['id_service'];
    $jumlah_sepatu = $_POST['jumlah_sepatu'];
    $merk_sepatu = $_POST['merk_sepatu'];
    $warna_sepatu = $_POST['warna_sepatu'];
    $tanggal_penjemputan = $_POST['tanggal_penjemputan'];

    // Insert ke database transaksi
    $query = "INSERT INTO transaksi (id_pelanggan, id_service, jumlah_sepatu, merk_sepatu, warna_sepatu, tanggal_penjemputan) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiisss', $id_pelanggan, $id_service, $jumlah_sepatu, $merk_sepatu, $warna_sepatu, $tanggal_penjemputan);

    if ($stmt->execute()) {
        header('Location: pembayaran.php?id_transaksi=' . $stmt->insert_id);
        exit;
    } else {
        $error = "Gagal menambahkan transaksi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Transaksi</title>
</head>

<body>
    <h2 class="form-title">Transaksi</h2>

    <?php if (isset($error)): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="" method="POST" class="form-container">
        <label for="id_service" class="form-label">Layanan:</label>
        <select name="id_service" id="id_service" class="form-select" required>
            <?php foreach ($services as $service): ?>
                <option value="<?= $service['id_service'] ?>">
                    <?= htmlspecialchars($service['nama_service']) ?> - Rp<?= htmlspecialchars($service['harga']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="jumlah_sepatu" class="form-label">Jumlah Sepatu:</label>
        <input type="number" name="jumlah_sepatu" id="jumlah_sepatu" class="form-input" required>

        <label for="merk_sepatu" class="form-label">Merk Sepatu:</label>
        <input type="text" name="merk_sepatu" id="merk_sepatu" class="form-input" required>

        <label for="warna_sepatu" class="form-label">Warna Sepatu:</label>
        <input type="text" name="warna_sepatu" id="warna_sepatu" class="form-input" required>

        <label for="tanggal_penjemputan" class="form-label">Tanggal Penjemputan:</label>
        <input type="date" name="tanggal_penjemputan" id="tanggal_penjemputan" class="form-input" required>
        <div class="profile">
            <button type="submit" class="submit-button">Buat Transaksi</button>
            <div class="back-to-home">
                <a href="index.php">
                    <button type="button" class="back-button">Back to Home</button>
                </a>
            </div>

        </div>

    </form>

</body>

</html>