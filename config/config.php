<?php
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        die("Error: .env file not found at " . $filePath);
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}
loadEnv('../.env');
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');
$port = getenv('DB_PORT') ?: 3306;
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8");

function env($key, $default = null) {
    return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
}

$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (str_starts_with(trim($line), '#')) continue;
        [$k, $v] = array_pad(explode('=', $line, 2), 2, '');
        $k = trim($k);
        $v = trim($v, " \t\n\r\0\x0B\"");
        if ($k !== '') {
            $_ENV[$k] = $v;
        }
    }
}

?>
