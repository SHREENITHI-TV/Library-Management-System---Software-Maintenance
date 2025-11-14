<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';

// Fetch all logs
$sql = "SELECT id, user_name, role, action, entity, entity_id, details, created_at
        FROM activity_logs
        ORDER BY created_at ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// Build filename
$downloadName = 'activity_logs_' . date('Ymd_His') . '.csv';

// CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="'.$downloadName.'"');

$out = fopen('php://output', 'w');

// Header row
fputcsv($out, [
    'ID',
    'Username',
    'Role',
    'Action',
    'Entity',
    'Entity ID',
    'Details (JSON/raw)',
    'Created At'
]);

while ($row = $result->fetch_assoc()) {
    fputcsv($out, [
        $row['id'],
        $row['user_name'],
        $row['role'],
        $row['action'],
        $row['entity'],
        $row['entity_id'],
        $row['details'],
        $row['created_at'],
    ]);
}

fclose($out);
$stmt->close();

// After exporting, clear the table
$del = $conn->prepare("DELETE FROM activity_logs");
$del->execute();
$del->close();

// We *could* try to log this, but logging into the same table we just emptied
// would just add one row back, which defeats the "clear" idea.
// So we don't log this particular operation into activity_logs itself.

exit;
