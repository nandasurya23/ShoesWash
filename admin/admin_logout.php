<?php
session_start();
session_unset();
session_destroy();

// Arahkan admin kembali ke halaman login setelah logout
header('Location: admin_login.php');
exit;
?>
