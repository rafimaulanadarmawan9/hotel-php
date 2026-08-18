<?php

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '3306';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: '';
$db   = getenv('DB_NAME') ?: 'db_ukk_2022';

$koneksi = mysqli_init();

if (!$koneksi) {
    die("Gagal menginisialisasi koneksi database.");
}

/*
 * Layerbase membutuhkan koneksi SSL.
 */
if ($host !== 'localhost' && $host !== '127.0.0.1') {
    mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);
}

if (!mysqli_real_connect(
    $koneksi,
    $host,
    $user,
    $pass,
    $db,
    (int) $port,
    NULL,
    ($host !== 'localhost' && $host !== '127.0.0.1')
        ? MYSQLI_CLIENT_SSL
        : 0
)) {
    die("Koneksi dengan database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");

?>