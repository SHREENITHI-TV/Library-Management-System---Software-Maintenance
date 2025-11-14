<?php
// LibraryManagementSystem/app/util/log_helper.php
require_once __DIR__ . '/../../dbconnect.php'; 

function current_user_name() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
}
function current_user_role() {
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

// We'll implement DB writes in Step 4 (activity logs)
function log_action($userName, $role, $action, $entity, $entityId, $details = null) {
    global $conn;
    $sql = "INSERT INTO activity_logs (user_name, role, action, entity, entity_id, details)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) return;
    $eid = isset($entityId) ? (string)$entityId : null;
    $stmt->bind_param("ssssss", $userName, $role, $action, $entity, $eid, $details);
    $stmt->execute();
    $stmt->close();
}
