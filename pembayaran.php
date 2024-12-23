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

// Ambil ID transaksi dari URL
if (!isset($_GET['id_transaksi'])) {
    header('Location: transaksi.php');
    exit;
}

$id_transaksi = $_GET['id_transaksi'];

// Ambil data transaksi
$sql = "SELECT t.id_transaksi, t.jumlah_sepatu, t.merk_sepatu, t.warna_sepatu, t.tanggal_penjemputan, 
               s.nama_service, s.harga 
        FROM transaksi t
        JOIN service s ON t.id_service = s.id_service
        WHERE t.id_transaksi = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_transaksi);
$stmt->execute();
$result = $stmt->get_result();
$transaksi = $result->fetch_assoc();

if (!$transaksi) {
    die("Transaksi tidak ditemukan.");
}

// Jika form pembayaran dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pelanggan = $_SESSION['user_id'];
    $total_pembayaran = $transaksi['harga'] * $transaksi['jumlah_sepatu'];

    // Insert ke tabel pembayaran
    $query = "INSERT INTO pembayaran (id_transaksi, id_pelanggan, total_pembayaran) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $id_transaksi, $id_pelanggan, $total_pembayaran);

    if ($stmt->execute()) {
        header('Location: pembayaran_sukses.php');
        exit;
    } else {
        $error = "Gagal melakukan pembayaran.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Pembayaran</title>
</head>
<body>
<h2 class="payment-title">Pembayaran</h2>

<?php if (isset($error)): ?>
    <p class="error-message"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<h3>Detail Transaksi</h3>
<div class="transaction-details">
    <p><strong>Service:</strong> <?= htmlspecialchars($transaksi['nama_service']) ?></p>
    <p><strong>Harga per Sepatu:</strong> Rp<?= number_format($transaksi['harga'], 0, ',', '.') ?></p>
    <p><strong>Jumlah Sepatu:</strong> <?= htmlspecialchars($transaksi['jumlah_sepatu']) ?></p>
    <p><strong>Merk Sepatu:</strong> <?= htmlspecialchars($transaksi['merk_sepatu']) ?></p>
    <p><strong>Warna Sepatu:</strong> <?= htmlspecialchars($transaksi['warna_sepatu']) ?></p>
    <p><strong>Tanggal Penjemputan:</strong> <?= htmlspecialchars($transaksi['tanggal_penjemputan']) ?></p>
    <p><strong>Total Pembayaran:</strong> Rp<?= number_format($transaksi['harga'] * $transaksi['jumlah_sepatu'], 0, ',', '.') ?></p>
</div>

<form action="" method="POST" class="payment-container">
    <button type="submit" class="payment-button">Bayar Sekarang</button>
</form>

</body>
</html>
