<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function aims_config(string $key, $default = null)
{
    $value = getenv($key);

    if ($value === false || $value === '') {
        $value = $_ENV[$key] ?? $default;
    }

    return $value;
}

function aims_db_connection(): ?mysqli
{
    $host = aims_config('DB_HOST', 'localhost');
    $username = aims_config('DB_USERNAME', 'root');
    $password = aims_config('DB_PASSWORD', '');
    $dbname = aims_config('DB_NAME', 'db_aims');
    $port = (int) aims_config('DB_PORT', 3306);

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $connection = new mysqli($host, $username, $password, $dbname, $port);
        $connection->set_charset('utf8mb4');
        return $connection;
    } catch (mysqli_sql_exception $e) {
        $_SESSION['db_error'] = 'Database connection failed: ' . $e->getMessage();
        return null;
    }
}

$conn = aims_db_connection();
