<?php
// Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define constants only once
if (!defined('LOCALHOST'))   define('LOCALHOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', '');
if (!defined('DB_NAME'))     define('DB_NAME', 'library_system');

// Create/reuse a single mysqli connection
if (!isset($conn) || !($conn instanceof mysqli)) {
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    if (!$conn) {
        die('DB connect failed: ' . mysqli_connect_error());
    }
    $db_select = mysqli_select_db($conn, DB_NAME);
    if (!$db_select) {
        die('DB select failed: ' . mysqli_error($conn));
    }
}
