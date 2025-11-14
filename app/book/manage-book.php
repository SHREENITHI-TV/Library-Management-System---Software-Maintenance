<?php
require_once __DIR__ . '/../../dbconnect.php';
$output = '';

$tab = isset($_POST['tab']) ? $_POST['tab'] : 'active';

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);

    if ($tab === 'deleted') {
        $query = "SELECT * FROM books
        WHERE deleted_at IS NOT NULL AND (
            title LIKE '%" . $search . "%' 
            OR author LIKE '%" . $search . "%' 
            OR publisher LIKE '%" . $search . "%' 
            OR year LIKE '%" . $search . "%' 
            OR category LIKE '%" . $search . "%'
        )";
    } else {
        $query = "SELECT * FROM books
        WHERE deleted_at IS NULL AND (
            title LIKE '%" . $search . "%' 
            OR author LIKE '%" . $search . "%' 
            OR publisher LIKE '%" . $search . "%' 
            OR year LIKE '%" . $search . "%' 
            OR category LIKE '%" . $search . "%'
        )";
    }
} else {
    if ($tab === 'deleted') {
        $query = "SELECT * FROM books WHERE deleted_at IS NOT NULL ORDER BY book_id DESC";
    } else {
        $query = "SELECT * FROM books WHERE deleted_at IS NULL ORDER BY book_id DESC";
    }
}

$result = mysqli_query($conn, $query);
if ($result === false) {
    http_response_code(500);
    echo "Query error";
    exit;
}

$count = mysqli_num_rows($result);
if ($count > 0) {
    $output .= '
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Published Year</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($rows = mysqli_fetch_assoc($result)) {
        $book_id  = (int)$rows['book_id'];
        $title    = htmlspecialchars($rows['title']);
        $author   = htmlspecialchars($rows['author']);
        $publisher= htmlspecialchars($rows['publisher']);
        $year     = htmlspecialchars($rows['year']);
        $category = htmlspecialchars($rows['category']);

        if ($tab === 'deleted') {
            // Deleted tab → Restore | Hard Delete | History
            $actions = '
              <div class="btn-group" role="group" aria-label="Deleted book actions">
                <a href="restore-book.php?id=' . $book_id . '"
                   class="btn btn-success btn-sm"
                   title="Restore">
                   Restore
                </a>
                <a href="hard-delete-book.php?id=' . $book_id . '"
                   class="btn btn-danger btn-sm"
                   title="Hard Delete"
                   onclick="return confirm(\'This will permanently delete this book and its history. Continue?\');">
                   <i class="uil uil-trash-alt"></i>
                </a>
                <a href="view-history.php?id=' . $book_id . '"
                   class="btn btn-info btn-sm"
                   title="History">
                   History
                </a>
              </div>
            ';
        } else {
            // Active tab → Update | Soft Delete | History
            $actions = '
              <div class="btn-group" role="group" aria-label="Active book actions">
                <a href="update-book.php?id=' . $book_id . '"
                   class="btn btn-success btn-sm"
                   title="Update">
                   Update
                </a>
                <a href="delete-book.php?id=' . $book_id . '"
                   class="btn btn-warning btn-sm"
                   title="Soft Delete"
                   onclick="return confirm(\'Delete this book? You can restore it later from the Deleted tab.\');">
                   <i class="uil uil-trash-alt"></i>
                </a>
                <a href="view-history.php?id=' . $book_id . '"
                   class="btn btn-info btn-sm"
                   title="History">
                   History
                </a>
              </div>
            ';
        }

        $output .= '
            <tr>
                <td>' . $book_id . '</td>
                <td>' . $title . '</td>
                <td>' . $author . '</td>
                <td>' . $publisher . '</td>
                <td>' . $year . '</td>
                <td>' . $category . '</td>
                <td>' . $actions . '</td>
            </tr>
        ';
    }

    $output .= '</tbody></table></div>';
    echo $output;
} else {
    echo 'Data Not Found';
}
