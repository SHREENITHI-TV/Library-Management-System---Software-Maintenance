<?php
require_once __DIR__ . '/../../dbconnect.php';

$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    $query = "
        SELECT student_id, firstname, lastname, department, batch
        FROM student
        WHERE
            student_id LIKE '%$search%' OR
            firstname  LIKE '%$search%' OR
            lastname   LIKE '%$search%' OR
            department LIKE '%$search%' OR
            batch      LIKE '%$search%'
        ORDER BY student_id DESC
    ";
} else {
    $query = "
        SELECT student_id, firstname, lastname, department, batch
        FROM student
        ORDER BY student_id DESC
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
            <th>Department</th>
            <th>Batch</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_assoc($result)) {
        $student_id = (int)$row['student_id'];
        $firstname  = htmlspecialchars($row['firstname']);
        $lastname   = htmlspecialchars($row['lastname']);
        $dept       = htmlspecialchars($row['department']);
        $batch      = htmlspecialchars($row['batch']);

        $output .= '
        <tr>
          <td>' . $student_id . '</td>
          <td>' . $firstname  . '</td>
          <td>' . $lastname   . '</td>
          <td>' . $dept       . '</td>
          <td>' . $batch      . '</td>
          <td>
            <a href="update-student.php?id=' . $student_id . '" class="btn btn-success btn-sm">Update</a>
            <a href="delete-student.php?id=' . $student_id . '"
               class="btn btn-danger btn-sm"
               onclick="return confirm(\'Delete this student? This is permanent if no transactions exist.\');">
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
