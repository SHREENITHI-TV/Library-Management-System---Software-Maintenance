<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';

include('../../format/header.php');
include('../../format/sidebar.php');

$user   = trim($_GET['user']   ?? '');
$action = trim($_GET['action'] ?? '');
$entity = trim($_GET['entity'] ?? '');

$where  = [];
$params = [];
$types  = '';

if ($user !== '') {
    $where[]  = "l.user_name = ?";
    $params[] = $user;
    $types   .= 's';
}
if ($action !== '') {
    $where[]  = "l.action = ?";
    $params[] = $action;
    $types   .= 's';
}
if ($entity !== '') {
    $where[]  = "l.entity = ?";
    $params[] = $entity;
    $types   .= 's';
}

$sql = "
    SELECT
        l.id,
        l.user_name,
        l.action,
        l.entity,
        l.entity_id,
        l.details,
        l.created_at,
        a.admin_id,
        a.firstname AS admin_firstname,
        a.lastname  AS admin_lastname,
        b.title     AS book_title
    FROM activity_logs l
    LEFT JOIN admin a
        ON a.username = l.user_name
    LEFT JOIN books b
        ON l.entity = 'book'
       AND b.book_id = l.entity_id
";

if ($where) {
    $sql .= " WHERE " . implode(' AND ', $where);
}

$sql .= " ORDER BY l.created_at DESC LIMIT 200";

$stmt = $conn->prepare($sql);
if ($where) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$res = $stmt->get_result();
?>
<div class="container">
    <br>

    <!-- Export & Clear button -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="mb-0">Log - Admin Activities</h2>
        <div>
            <a href="export-activity.php"
               class="btn btn-danger btn-sm"
               onclick="return confirm('This will export ALL activity logs as CSV and then clear them from the database. Continue? Refresh after done!');">
                Export &amp; Clear Logs
            </a>
        </div>
    </div>

    <form class="row g-2 mb-3" method="get">
        <div class="col-auto">
            <input class="form-control form-control-sm"
                   name="user"
                   placeholder="Username"
                   value="<?= htmlspecialchars($user) ?>">
        </div>
        <div class="col-auto">
            <input class="form-control form-control-sm"
                   name="action"
                   placeholder="Action Performed"
                   value="<?= htmlspecialchars($action) ?>">
        </div>
        <div class="col-auto">
            <input class="form-control form-control-sm"
                   name="entity"
                   placeholder="Entity ( book or user)"
                   value="<?= htmlspecialchars($entity) ?>">
        </div>
        <div class="col-auto">
            <button class="btn btn-sm btn-primary">Filter</button>
            <a class="btn btn-sm btn-secondary" href="view-activity.php">Clear Filters</a>
        </div>
    </form>

    <style>
        .activity-log-table thead th {
            background: #eef0ff;          
            color: #343a40;
            border-bottom: 2px solid #d0d4ff;
        }
        .activity-log-table tbody tr:nth-child(odd) {
            background-color: #f9fbff;   
        }
        .activity-log-table tbody tr:hover {
            background-color: #e6f2ff;  
        }
        .activity-log-table td:nth-child(3) {
            font-weight: 600;           
            color: #0d6efd;              
        }
        .activity-log-table td:nth-child(5) {
            color: #495057;
            font-size: 0.9rem;           
        }
    </style>

    <!-- Table -->
    <table class="table table-bordered table-striped table-hover activity-log-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Action Performed</th>
                <th>Action Performed On/By</th>
                <th>When</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $res->fetch_assoc()): ?>
            <?php
            // User ID from admin table
            $userId = $row['admin_id'] ?? null;
            if ($userId === null || $userId === '') {
                $userId = '-';
            }

            // Action performed on/by
            $target = '';
            if ($row['entity'] === 'book') {
                $bookId    = $row['entity_id'];
                $bookTitle = $row['book_title'] ?? '';
                if ($bookTitle !== '') {
                    $target = 'Book #' . htmlspecialchars($bookId) . ' — ' . htmlspecialchars($bookTitle);
                } else {
                    $target = 'Book #' . htmlspecialchars($bookId);
                }
            } elseif ($row['entity'] === 'user') {
                $fullName = trim(
                    ($row['admin_firstname'] ?? '') . ' ' .
                    ($row['admin_lastname']  ?? '')
                );
                if ($fullName !== '') {
                    $target = htmlspecialchars($fullName);
                } else {
                    $target = htmlspecialchars($row['user_name']);
                }
            } else {
                $target = htmlspecialchars((string)$row['entity_id']);
            }

            $detailsRaw    = $row['details'] ?? '';
            $prettyDetails = '';
            $decoded       = json_decode($detailsRaw, true);

            if (is_array($decoded)) {
                if ($row['action'] === 'UPDATE' && isset($decoded['changed_fields']) && is_array($decoded['changed_fields'])) {
                    $fields = array_map('htmlspecialchars', $decoded['changed_fields']);
                    if ($fields) {
                        $prettyDetails = 'Changed fields: ' . implode(', ', $fields);
                    }
                } elseif ($row['action'] === 'CREATE' && $row['entity'] === 'book') {
                    $t = htmlspecialchars($decoded['title']     ?? '');
                    $a = htmlspecialchars($decoded['author']    ?? '');
                    $y = htmlspecialchars($decoded['year']      ?? '');
                    $c = htmlspecialchars($decoded['category']  ?? '');
                    $parts = [];
                    if ($t !== '') $parts[] = $t;
                    if ($a !== '') $parts[] = 'by ' . $a;
                    if ($y !== '') $parts[] = '(' . $y . ')';
                    if ($c !== '') $parts[] = '[' . $c . ']';
                    if ($parts) {
                        $prettyDetails = 'Created book: ' . implode(' ', $parts);
                    }
                } elseif ($row['action'] === 'DELETE' && isset($decoded['soft']) && $decoded['soft']) {
                    $prettyDetails = 'Deleted - book can be restored.';
                } elseif ($row['action'] === 'HARD_DELETE' && isset($decoded['hard']) && $decoded['hard']) {
                    $t = htmlspecialchars($decoded['title'] ?? '');
                    if ($t !== '') {
                        $prettyDetails = 'Deleted - book "' . $t . '" - Permanently removed.';
                    } else {
                        $prettyDetails = 'Book permanently removed';
                    }
                } else {
                    $changes = [];
                    foreach ($decoded as $key => $val) {
                        if (str_ends_with($key, '_before')) {
                            $field    = substr($key, 0, -7);
                            $before   = $val;
                            $afterKey = $field . '_after';

                            if (array_key_exists($afterKey, $decoded)) {
                                $after = $decoded[$afterKey];
                                if ($before !== $after) {
                                    $label = ucfirst($field);
                                    $changes[] = sprintf(
                                        '%s: %s → %s',
                                        htmlspecialchars($label),
                                        htmlspecialchars((string)$before),
                                        htmlspecialchars((string)$after)
                                    );
                                }
                            }
                        }
                    }
                    if ($changes) {
                        $prettyDetails = '<ul class="mb-0"><li>' . implode('</li><li>', $changes) . '</li></ul>';
                    } else {
                        $prettyDetails = '';
                    }
                }
            } else {
                $prettyDetails = '';
            }
            ?>
            <tr>
                <td><?= htmlspecialchars($userId) ?></td>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= htmlspecialchars($row['action']) ?></td>
                <td><?= $target ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td><?= $prettyDetails ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include('../../format/footer.php'); ?>
