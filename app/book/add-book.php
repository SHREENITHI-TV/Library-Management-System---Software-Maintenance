<?php
require_once __DIR__ . '/../../dbconnect.php';      // DB + session
require_once __DIR__ . '/../util/log_helper.php';  // log_action, current_user_name()

include('../../format/header.php');
include('../../format/sidebar.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // get data from form
    $title     = trim($_POST['title']     ?? '');
    $author    = trim($_POST['author']    ?? '');
    $publisher = trim($_POST['publisher'] ?? '');
    $year      = trim($_POST['year']      ?? '');
    $category  = trim($_POST['category']  ?? '');

    if ($title === '' || $author === '' || $publisher === '' || $year === '' || $category === '') {
        echo "<script>alert('All fields are required');</script>";
    } else {
        // Insert using prepared statement
        $sql = "INSERT INTO books (title, author, publisher, year, category)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo "<script>alert('Failed to prepare insert');</script>";
        } else {
            $stmt->bind_param("sssss", $title, $author, $publisher, $year, $category);
            $ok = $stmt->execute();

            if ($ok) {
                // Get the new book_id
                $newBookId = $conn->insert_id;

                // Log CREATE into activity_logs
                $details = json_encode(
                    [
                        'title'    => $title,
                        'author'   => $author,
                        'publisher'=> $publisher,
                        'year'     => $year,
                        'category' => $category
                    ],
                    JSON_UNESCAPED_UNICODE
                );
                log_action(
                    current_user_name(),
                    current_user_role(),
                    'CREATE',
                    'book',
                    $newBookId,
                    $details
                );

                // Redirect: either back to list or keep adding
                echo "<script>
                    var r = confirm('Book added successfully. Add another book?');
                    if (r === true) {
                        window.location.href='add-book.php';
                    } else {
                        window.location.href='book.php';
                    }
                </script>";
                $stmt->close();
                include('../../format/footer.php');
                exit;
            } else {
                $stmt->close();
                echo "<script>alert('Failed to add book');</script>";
            }
        }
    }
}
?>

<!-- home/managebooks -->
<div class="container">
    <br>
    <h1 class="text-center">Add Book</h1>
    <br>
    <form action="add-book.php" method="POST">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Title:</th>
                <td>
                    <input type="text" name="title" class="form-control" placeholder="Enter book title" required>
                </td>
            </tr>
            <tr>
                <th>Author:</th>
                <td>
                    <input type="text" name="author" class="form-control" placeholder="Enter book author" required>
                </td>
            </tr>
            <tr>
                <th>Publisher:</th>
                <td>
                    <input type="text" name="publisher" class="form-control" placeholder="Enter publisher" required>
                </td>
            </tr>
            <tr>
                <th>Published Year:</th>
                <td>
                    <input type="text" name="year" class="form-control" placeholder="Enter published year" required>
                </td>
            </tr>
            <tr>
                <th>Category:</th>
                <td>
                    <input type="text" name="category" class="form-control" placeholder="Enter book category" required>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <input type="submit" name="submit" value="Add Book" class="btn-secondary btn-lg">
        </div>
    </form>
</div>

<?php
include('../../format/footer.php');
?>
