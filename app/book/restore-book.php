<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';

if (!isset($_GET['id'])) { http_response_code(400); exit('Missing id'); }
$book_id = (int)$_GET['id'];

$sql = "UPDATE books SET deleted_at = NULL WHERE book_id = $book_id";
$res = mysqli_query($conn, $sql);

// Log
log_action(current_user_name(), current_user_role(), 'RESTORE', 'book', $book_id, null);

header('Location: book.php');
