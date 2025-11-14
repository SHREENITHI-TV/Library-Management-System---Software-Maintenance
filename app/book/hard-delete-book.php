<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "Missing id";
    exit;
}

$book_id = (int)$_GET['id'];

// Optional: fetch title for nicer logging (in case FK constraints delete versions etc.)
$title = null;
$stmt = $conn->prepare("SELECT title FROM books WHERE book_id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $title = $row['title'];
}
$stmt->close();

// HARD DELETE: remove the book row entirely
$sqlDel = "DELETE FROM books WHERE book_id = ?";
$stmtDel = $conn->prepare($sqlDel);
$stmtDel->bind_param("i", $book_id);
$ok = $stmtDel->execute();
$stmtDel->close();

// Log action regardless; if delete failed, it will still be obvious something is wrong.
$details = json_encode(
    [
        'hard'  => true,
        'title' => $title,
    ],
    JSON_UNESCAPED_UNICODE
);

log_action(
    current_user_name(),
    current_user_role(),
    'HARD_DELETE',     // distinguish from soft DELETE
    'book',
    $book_id,
    $details
);

// Redirect back to Deleted tab so user sees the effect
if ($ok) {
    header('Location: book.php');   // JS tab script will pick last state; user can click Deleted again
    exit;
} else {
    echo "<script>alert('Hard delete failed (book may be referenced by transactions).');window.location.href='book.php';</script>";
    exit;
}
