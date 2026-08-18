<?php

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Hilangkan slash awal
$requestPath = ltrim($requestPath, '/');

// Kalau membuka domain utama, arahkan ke index.php
if ($requestPath === '') {
    $requestPath = 'index.php';
}

// Hanya izinkan file PHP
if (!str_ends_with(strtolower($requestPath), '.php')) {
    http_response_code(404);
    exit('Not Found');
}

// Normalisasi path
$requestPath = str_replace('\\', '/', $requestPath);

// Cegah directory traversal
if (str_contains($requestPath, '..')) {
    http_response_code(403);
    exit('Forbidden');
}

$file = dirname(__DIR__) . '/' . $requestPath;

if (!is_file($file)) {
    http_response_code(404);
    exit('PHP file not found');
}

require $file;