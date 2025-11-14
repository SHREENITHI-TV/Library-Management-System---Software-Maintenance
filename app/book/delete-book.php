<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';

if (!isset($_GET['id'])) { http_response_code(400); exit('Missing id'); }
$book_id = (int)$_GET['id'];

// Soft delete
$sql = "UPDATE books SET deleted_at = NOW() WHERE book_id = $book_id";
$res = mysqli_query($conn, $sql);

// Log
$details = json_encode(['soft'=>true], JSON_UNESCAPED_UNICODE);
log_action(current_user_name(), current_user_role(), 'DELETE', 'book', $book_id, $details);

header('Location: book.php');
