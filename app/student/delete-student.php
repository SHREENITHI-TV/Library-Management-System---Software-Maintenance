<?php
require_once __DIR__ . '/../../dbconnect.php';

if (!isset($_GET['id'])) {
    echo "Missing student id";
    exit;
}

$student_id = (int)$_GET['id'];

// Check if this student is referenced in transaction table
$chk = $conn->prepare("SELECT COUNT(*) AS cnt FROM transaction WHERE student_id = ?");
$chk->bind_param("i", $student_id);
$chk->execute();
$resChk = $chk->get_result();
$rowChk = $resChk->fetch_assoc();
$chk->close();

if ($rowChk && (int)$rowChk['cnt'] > 0) {
    // Student has transaction history – do NOT delete.
    echo "<script>
        alert('Cannot delete this student because there are transactions linked to them. '
            + 'For audit reasons, students with borrowing history are kept in the system.');
        window.location.href = 'students.php';
    </script>";
    exit;
}

// No transactions – safe to delete the row
$stmt = $conn->prepare("DELETE FROM student WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    header('Location: students.php');
    exit;
} else {
    echo "<script>
        alert('Deletion failed: student not found.');
        window.location.href = 'students.php';
    </script>";
    exit;
}
