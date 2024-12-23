<?php
session_start();

// Menghapus semua sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Redirect ke halaman index.php setelah logout
header('Location: index.php');
exit;
?>
