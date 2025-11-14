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

// Defaults so we never get “undefined variable” warnings
$student_id   = '';
$firstname    = '';
$lastname     = '';
$department   = '';
$batch        = '';
$book_id      = '';
$title        = '';
$author       = '';
$publisher    = '';
$year         = '';
$category     = '';
$date_borrowed = '';
$date_due      = '';

// Load transaction (only borrowed)
$sql = "SELECT * FROM transaction
        WHERE tran_id = $tran_id AND status = 'borrowed'";
$res = mysqli_query($conn, $sql);

if ($res && mysqli_num_rows($res) === 1) {
    $rows          = mysqli_fetch_assoc($res);
    $tran_id       = $rows['tran_id'];
    $book_id       = $rows['book_id'];
    $student_id    = $rows['student_id'];
    $date_borrowed = $rows['date_borrowed'];
    $date_due      = $rows['date_due'];

    // Student info (no more deleted_at column)
    if (!empty($student_id)) {
        $studentsql = "SELECT * FROM student WHERE student_id = $student_id";
        $resStu = mysqli_query($conn, $studentsql);

        if ($resStu && mysqli_num_rows($resStu) === 1) {
            $rowStu    = mysqli_fetch_assoc($resStu);
            $student_id = $rowStu['student_id'];
            $firstname  = $rowStu['firstname'];
            $lastname   = $rowStu['lastname'];
            $department = $rowStu['department'];
            $batch      = $rowStu['batch'];
        }
    }

    // Book info
    if (!empty($book_id)) {
        $booksql = "SELECT * FROM books WHERE book_id = $book_id";
        $resBook = mysqli_query($conn, $booksql);

        if ($resBook && mysqli_num_rows($resBook) === 1) {
            $rowBook  = mysqli_fetch_assoc($resBook);
            $book_id  = $rowBook['book_id'];
            $title    = $rowBook['title'];
            $author   = $rowBook['author'];
            $publisher= $rowBook['publisher'];
            $year     = $rowBook['year'];
            $category = $rowBook['category'];
        }
    }
} else {
    echo "ERROR! NO INFO " . mysqli_error($conn);
}
?>

<div class="container-fluid">
    <br>
    <h1 class="text-center">Transaction Details</h1>
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
                        <td>Checked Out</td>
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
