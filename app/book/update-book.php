<?php
require_once __DIR__ . '/../../dbconnect.php';
require_once __DIR__ . '/../util/log_helper.php';


include('../../format/header.php');
include('../../format/sidebar.php');

// Load book for edit
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "Missing id";
    include('../../format/footer.php');
    exit;
}
$book_id = (int)$_GET['id'];

// Fetch current book to prefill form
$sql = "SELECT * FROM books WHERE book_id = ?";
$st  = $conn->prepare($sql);
$st->bind_param("i", $book_id);
$st->execute();
$res = $st->get_result();
if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    $title     = $row['title'];
    $author    = $row['author'];
    $publisher = $row['publisher'];
    $year      = $row['year'];
    $category  = $row['category'];
} else {
    echo "<h4>Book not found</h4>";
    include('../../format/footer.php');
    exit;
}
$st->close();

if (isset($_POST['submit'])) {
    // gather posted values
    $title     = $_POST['title'];
    $author    = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year      = $_POST['year'];     
    $category  = $_POST['category'];


    // Fetch current values (pre-update) again (to be safe)
    $sqlCur = "SELECT book_id, title, author, publisher, year, category
               FROM books WHERE book_id = ?";
    $stCur = $conn->prepare($sqlCur);
    $stCur->bind_param("i", $book_id);
    $stCur->execute();
    $resCur = $stCur->get_result();
    $before = $resCur->fetch_assoc();
    $stCur->close();

    // Compute next version number
    $verSql = "SELECT COALESCE(MAX(version_no), 0) + 1 AS next_no
               FROM book_versions WHERE book_id = ?";
    $stVer = $conn->prepare($verSql);
    $stVer->bind_param("i", $book_id);
    $stVer->execute();
    $resVer = $stVer->get_result();
    $rowVer = $resVer->fetch_assoc();
    $next_no = $rowVer ? (int)$rowVer['next_no'] : 1;
    $stVer->close();

    // Compute diff (before vs after)
    $diff = [];
    if ($before) {
        if ($before['title']     !== $title)     $diff['title']     = ['before'=>$before['title'],     'after'=>$title];
        if ($before['author']    !== $author)    $diff['author']    = ['before'=>$before['author'],    'after'=>$author];
        if ($before['publisher'] !== $publisher) $diff['publisher'] = ['before'=>$before['publisher'], 'after'=>$publisher];
        if ($before['year']      !== $year)      $diff['year']      = ['before'=>$before['year'],      'after'=>$year];
        if ($before['category']  !== $category)  $diff['category']  = ['before'=>$before['category'],  'after'=>$category];
    }
    $diff_json = !empty($diff) ? json_encode($diff, JSON_UNESCAPED_UNICODE) : null;

    //Insert snapshot (previous state) + diff_json
    if ($before) {
        $insSql = "INSERT INTO book_versions
            (book_id, version_no, title, author, publisher, year, category, changed_by, diff_json)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stIns = $conn->prepare($insSql);
        $changed_by = isset($_SESSION['username']) ? $_SESSION['username'] : 'guest';
        
        $stIns->bind_param(
            "iisssssss",
            $before['book_id'],
            $next_no,
            $before['title'],
            $before['author'],
            $before['publisher'],
            $before['year'],
            $before['category'],
            $changed_by,
            $diff_json
        );
        $stIns->execute();
        $stIns->close();
    }

    // UPDATE
$sqlUpd = "UPDATE books SET
                title = ?,
                author = ?,
                publisher = ?,
                year = ?,
                category = ?
           WHERE book_id = ?";
$stUpd = $conn->prepare($sqlUpd);
$stUpd->bind_param("sssssi", $title, $author, $publisher, $year, $category, $book_id);
$ok = $stUpd->execute();
$stUpd->close();

if ($ok) {
    // Log structured diff for Activity Log details
    if (!empty($before)) {
        $detailsArr = [
            'title_before'     => $before['title'],
            'title_after'      => $title,
            'author_before'    => $before['author'],
            'author_after'     => $author,
            'publisher_before' => $before['publisher'],
            'publisher_after'  => $publisher,
            'year_before'      => $before['year'],
            'year_after'       => $year,
            'category_before'  => $before['category'],
            'category_after'   => $category,
        ];
        $detailsJson = json_encode($detailsArr);

        log_action(
            current_user_name(),
            current_user_role(),
            'UPDATE',
            'book',
            $book_id,
            $detailsJson
        );
    }

    echo "<script>window.location.href='book.php';</script>";
    include('../../format/footer.php');
    exit;
} else {
    echo "<script>alert('Book Update Failed'); window.location.href='book.php';</script>";
    include('../../format/footer.php');
    exit;
}
}
?>

<div class="container">
    <br>
    <h1 class="text-center">Update Book</h1>
    <br>
    <form action="" method="post">
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="row">Title:</th>
                <td><input type="text" name="title" value="<?= htmlspecialchars($title) ?>" class="form-control"></td>
            </tr>
            <tr>
                <th scope="row">Author:</th>
                <td><input type="text" name="author" value="<?= htmlspecialchars($author) ?>" class="form-control"></td>
            </tr>
            <tr>
                <th scope="row">Publisher:</th>
                <td><input type="text" name="publisher" value="<?= htmlspecialchars($publisher) ?>" class="form-control"></td>
            </tr>
            <tr>
                <th scope="row">Published Year:</th>
                <td><input type="text" name="year" value="<?= htmlspecialchars($year) ?>" class="form-control"></td>
            </tr>
            <tr>
                <th scope="row">Category:</th>
                <td><input type="text" name="category" value="<?= htmlspecialchars($category) ?>" class="form-control"></td>
            </tr>
        </table>
        <div class="text-center">
            <input type="submit" name="submit" value="Save Changes" class="btn-secondary btn-lg">
        </div>
    </form>
</div>

<?php include('../../format/footer.php'); ?>
