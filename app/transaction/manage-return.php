<?php
require_once __DIR__ . '/../../dbconnect.php';

$output = '';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    $query = "
      SELECT 
          t.tran_id,
          t.book_id,
          t.student_id,
          t.date_borrowed,
          t.date_due,
          t.date_returned,
          t.status,
          b.title       AS book_title,
          s.firstname   AS student_firstname,
          s.lastname    AS student_lastname
      FROM transaction t
      JOIN books b    ON b.book_id = t.book_id
      JOIN student s  ON s.student_id = t.student_id
      WHERE t.status = 'returned'
        AND (
            t.book_id        LIKE '%$search%' OR
            t.student_id     LIKE '%$search%' OR
            b.title          LIKE '%$search%' OR
            s.firstname      LIKE '%$search%' OR
            s.lastname       LIKE '%$search%' OR
            t.date_borrowed  LIKE '%$search%' OR
            t.date_due       LIKE '%$search%' OR
            t.date_returned  LIKE '%$search%'
        )
      ORDER BY t.tran_id DESC
    ";
} else {
    $query = "
      SELECT 
          t.tran_id,
          t.book_id,
          t.student_id,
          t.date_borrowed,
          t.date_due,
          t.date_returned,
          t.status,
          b.title       AS book_title,
          s.firstname   AS student_firstname,
          s.lastname    AS student_lastname
      FROM transaction t
      JOIN books b    ON b.book_id = t.book_id
      JOIN student s  ON s.student_id = t.student_id
      WHERE t.status = 'returned'
      ORDER BY t.tran_id DESC
    ";
}

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {

    $output .= '
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Book ID</th>
            <th>Book Title</th>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Date Borrowed</th>
            <th>Date Due</th>
            <th>Date Returned</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
    ';

    while ($rows = mysqli_fetch_assoc($result)) {

        $tran_id       = $rows['tran_id'];
        $book_id       = $rows['book_id'];
        $student_id    = $rows['student_id'];
        $date_borrowed = $rows['date_borrowed'];
        $date_due      = $rows['date_due'];
        $date_returned = $rows['date_returned'];
        $book_title    = $rows['book_title'];
        $student_name  = trim($rows['student_firstname'] . ' ' . $rows['student_lastname']);

        // LATE RETURN
        $late_label = '';
        if (!empty($date_returned) && $date_returned > $date_due) {
            $late_label = '<span style="color:red; font-weight:bold;">Returned Late</span>';
        }

        $output .= '
        <tr>
          <td>' . htmlspecialchars($book_id) . '</td>
          <td>' . htmlspecialchars($book_title) . '</td>
          <td>' . htmlspecialchars($student_id) . '</td>
          <td>' . htmlspecialchars($student_name) . '</td>
          <td>' . htmlspecialchars($date_borrowed) . '</td>
          <td>' . htmlspecialchars($date_due) . '</td>
          <td>' . htmlspecialchars($date_returned) . '</td>
          <td>' . $late_label . '</td>
          <td>
            <a href="details-return.php?id=' . $tran_id . '" class="btn btn-success btn-sm">Details</a>
          </td>
        </tr>
        ';
    }

    $output .= '</tbody></table></div>';
    echo $output;

} else {
    echo 'Data Not Found';
}
