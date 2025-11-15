<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<?php
$date = date('Y-m-d');

$firstname  = '';
$lastname   = '';
$department = '';
$batch      = '';
$book_id    = '';
$title      = '';
$author     = '';
$publisher  = '';
$year       = '';
$category   = '';

if (isset($_POST['Check'])) {

    if (isset($_POST['student_id'])) {
        // cast to int just to be safe
        $student_id = (int)$_POST['student_id'];

        $sql = "SELECT * FROM student WHERE student_id = $student_id";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row        = mysqli_fetch_assoc($res);
                $student_id = $row['student_id'];
                $firstname  = $row['firstname'];
                $lastname   = $row['lastname'];
                $department = $row['department'];
                $batch      = $row['batch'];
            }
        }
    }

    if (isset($_POST['book_id'])) {
        $book_id = $_POST['book_id'];

        $sql = "SELECT * FROM books WHERE book_id = $book_id";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {

            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row       = mysqli_fetch_assoc($res);
                $book_id   = $row['book_id'];
                $title     = $row['title'];
                $author    = $row['author'];
                $publisher = $row['publisher'];
                $year      = $row['year'];
                $category  = $row['category'];
            }
        }
    }
}

if (isset($_POST['Borrow'])) {

    $student_id = $_POST['student_id'];
    $book_id    = $_POST['book_id'];
    $date_due   = $_POST['date_due'];

    $sql = "INSERT INTO transaction SET
        book_id      = '$book_id',
        student_id   = '$student_id',
        date_due     = '$date_due',
        status       = 'borrowed'
    ";
    $res = mysqli_query($conn, $sql);
    if ($res == TRUE) {
        echo "<script> 
            window.location.href='borrow.php';
        </script>";
    } else {
        echo 'Failed ' . mysqli_error($conn);
    }
}
?>

<div class="container">
    <br>
    <h1 class="text-center">Add Transaction</h1>
    <div class="row">
        <div class="col">
            <form action="" method="POST">
                <br>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Borrowed Date:</th>
                        <td>
                            <input type="text" name="date_borrowed" value="<?php echo $date; ?>" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Student No:</th>
                        <td>
                            <input type="text"
                                   value="<?php echo isset($_POST['student_id']) ? htmlspecialchars($student_id) : ''; ?>"
                                   placeholder="Enter Student ID"
                                   name="student_id"
                                   class="form-control"
                                   required>
                        </td>
                    </tr>

                </table>
        </div>
        <div class="col">

            <br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Due Date:</th>
                    <td>
                        <input type="date"
                               value="<?php echo isset($_POST['date_due']) ? htmlspecialchars($_POST['date_due']) : ''; ?>"
                               name="date_due"
                               class="form-control"
                               required>
                    </td>
                </tr>
                <tr>
                    <th>Book No:</th>
                    <td>
                        <input type="text"
                               value="<?php echo isset($_POST['book_id']) ? htmlspecialchars($book_id) : ''; ?>"
                               placeholder="Enter Book ID"
                               name="book_id"
                               class="form-control"
                               required>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <div class="text-center">
        <input type="submit" name="Check" value="Check" class="btn-secondary btn-lg me-md-3">
        <input type="submit" name="Borrow" value="Borrow" class="btn-secondary btn-lg me-md-3">
    </div>
    </form>
    <br>

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Student First Name: </th>
                    <td><?php echo htmlspecialchars($firstname); ?></td>
                </tr>
                <tr>
                    <th>Student Last Name: </th>
                    <td><?php echo htmlspecialchars($lastname); ?></td>
                </tr>
                <tr>
                    <th>Department: </th>
                    <td><?php echo htmlspecialchars($department); ?></td>
                </tr>
                <tr>
                    <th>Batch: </th>
                    <td><?php echo htmlspecialchars($batch); ?></td>
                </tr>
            </table>
        </div>

        <div class="col">
            <table class="table table-bordered table-striped">
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
    <br>
</div>

</div>
<?php
include('../../format/footer.php');
?>
