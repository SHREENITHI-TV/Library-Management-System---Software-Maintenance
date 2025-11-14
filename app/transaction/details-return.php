<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<?php
if (!isset($_GET['id'])) {
    echo "Missing transaction id";
    include('../../format/footer.php');
    exit;
}

$tran_id = (int)$_GET['id'];

// 1) Load the transaction (must be returned)
$sql = "SELECT * FROM transaction
        WHERE tran_id = $tran_id AND status = 'returned'";
$res = mysqli_query($conn, $sql);

if ($res && mysqli_num_rows($res) === 1) {
    $rows          = mysqli_fetch_assoc($res);
    $tran_id       = $rows['tran_id'];
    $book_id       = $rows['book_id'];
    $student_id    = $rows['student_id'];
    $date_borrowed = $rows['date_borrowed'];
    $date_returned = $rows['date_returned'];
    $date_due      = $rows['date_due'];

    // 2) Load student info (now using department + batch)
    $firstname  = '';
    $lastname   = '';
    $department = '';
    $batch      = '';

    if (!empty($student_id)) {
        $studentsql = "SELECT * FROM student WHERE student_id = $student_id";
        $sres = mysqli_query($conn, $studentsql);
        if ($sres && mysqli_num_rows($sres) === 1) {
            $row        = mysqli_fetch_assoc($sres);
            $student_id = $row['student_id'];
            $firstname  = $row['firstname'];
            $lastname   = $row['lastname'];
            $department = $row['department'];
            $batch      = $row['batch'];
        }
    }

    // 3) Load book info
    $title     = '';
    $author    = '';
    $publisher = '';
    $year      = '';
    $category  = '';

    if (!empty($book_id)) {
        $booksql = "SELECT * FROM books WHERE book_id = $book_id";
        $bres = mysqli_query($conn, $booksql);
        if ($bres && mysqli_num_rows($bres) === 1) {
            $row       = mysqli_fetch_assoc($bres);
            $book_id   = $row['book_id'];
            $title     = $row['title'];
            $author    = $row['author'];
            $publisher = $row['publisher'];
            $year      = $row['year'];
            $category  = $row['category'];
        }
    }
} else {
    echo "ERROR! NO INFO " . mysqli_error($conn);
    include('../../format/footer.php');
    exit;
}
?>

<div class="container-fluid">
    <br>
    <h1 class="text-center">Return Details</h1>
    <br>
    <div class="row">

        <div class="col">
            <form action="" method="POST">
                <br>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Borrowed Date:</th>
                        <td><?php echo htmlspecialchars($date_borrowed); ?></td>
                    </tr>
                    <tr>
                        <th>Returned Date:</th>
                        <td><?php echo htmlspecialchars($date_returned); ?></td>
                    </tr>
                    <tr>
                        <th>Student No:</th>
                        <td><?php echo htmlspecialchars($student_id); ?></td>
                    </tr>
                    <tr>
                        <th>Student First Name:</th>
                        <td><?php echo htmlspecialchars($firstname); ?></td>
                    </tr>
                    <tr>
                        <th>Student Last Name:</th>
                        <td><?php echo htmlspecialchars($lastname); ?></td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td><?php echo htmlspecialchars($department); ?></td>
                    </tr>
                    <tr>
                        <th>Batch:</th>
                        <td><?php echo htmlspecialchars($batch); ?></td>
                    </tr>
                </table>
        </div>

        <div class="col">
            <br>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Due Date:</th>
                    <td><?php echo htmlspecialchars($date_due); ?></td>
                </tr>
                <tr>
                    <th>Book No:</th>
                    <td><?php echo htmlspecialchars($book_id); ?></td>
                </tr>
                <tr>
                    <th>Title:</th>
                    <td><?php echo htmlspecialchars($title); ?></td>
                </tr>
                <tr>
                    <th>Author:</th>
                    <td><?php echo htmlspecialchars($author); ?></td>
                </tr>
                <tr>
                    <th>Publisher:</th>
                    <td><?php echo htmlspecialchars($publisher); ?></td>
                </tr>
                <tr>
                    <th>Published Year:</th>
                    <td><?php echo htmlspecialchars($year); ?></td>
                </tr>
                <tr>
                    <th>Category:</th>
                    <td><?php echo htmlspecialchars($category); ?></td>
                </tr>
            </table>
        </div>
    </div>
    </form>
</div>

</div>
<?php include('../../format/footer.php'); ?>
