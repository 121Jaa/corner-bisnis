<?php
header('Content-Type: application/json');
$start = microtime(true);

$result = [
    'env' => [
        'DB_HOST' => getenv('DB_HOST') ?: '(kosong)',
        'DB_PORT' => getenv('DB_PORT') ?: '(kosong)',
        'DB_DATABASE' => getenv('DB_DATABASE') ?: '(kosong)',
        'DB_USERNAME' => getenv('DB_USERNAME') ?: '(kosong)',
        'DB_PASSWORD' => getenv('DB_PASSWORD') ? 'ADA' : '(kosong)',
        'APP_KEY' => getenv('APP_KEY') ? 'ADA' : '(kosong)',
    ],
    'extensions' => [
        'pdo_mysql' => extension_loaded('pdo_mysql'),
    ],
];

try {
    $pdo = new PDO(
        "mysql:host=" . getenv('DB_HOST') . ";port=" . getenv('DB_PORT') . ";dbname=" . getenv('DB_DATABASE'),
        getenv('DB_USERNAME'),
        getenv('DB_PASSWORD'),
        [
            PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            PDO::ATTR_TIMEOUT => 5,
        ]
    );
    $result['db'] = ['status' => 'OK', 'elapsed_ms' => round((microtime(true) - $start) * 1000)];
} catch (Throwable $e) {
    $result['db'] = ['status' => 'GAGAL', 'error' => $e->getMessage(), 'elapsed_ms' => round((microtime(true) - $start) * 1000)];
}

echo json_encode($result, JSON_PRETTY_PRINT);