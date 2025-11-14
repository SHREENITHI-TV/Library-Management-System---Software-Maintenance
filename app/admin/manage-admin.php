<?php
require_once __DIR__ . '/../../dbconnect.php';

$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    $query = "
        SELECT admin_id, firstname, lastname, username
        FROM admin
        WHERE
            admin_id LIKE '%$search%' OR
            firstname LIKE '%$search%' OR
            lastname  LIKE '%$search%' OR
            username  LIKE '%$search%'
        ORDER BY admin_id ASC
    ";
} else {
    $query = "
        SELECT admin_id, firstname, lastname, username
        FROM admin
        ORDER BY admin_id ASC
    ";
}

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {

    $output .= '
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    ';

    while ($row = mysqli_fetch_assoc($result)) {
        $admin_id  = (int)$row['admin_id'];
        $firstname = htmlspecialchars($row['firstname']);
        $lastname  = htmlspecialchars($row['lastname']);
        $username  = htmlspecialchars($row['username']);

        $output .= '
            <tr>
                <td>' . $admin_id . '</td>
                <td>' . $firstname . '</td>
                <td>' . $lastname . '</td>
                <td>' . $username . '</td>
                <td>
                    <a href="update-admin.php?id=' . $admin_id . '" class="btn btn-success btn-sm">Update</a>
                    <a href="delete-admin.php?id=' . $admin_id . '"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm(\'Delete this admin?\');">
                       Delete
                    </a>
                </td>
            </tr>
        ';
    }

    $output .= '</tbody></table></div>';
    echo $output;

} else {
    echo 'Data Not Found';
}
