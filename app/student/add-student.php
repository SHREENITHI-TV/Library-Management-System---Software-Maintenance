<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>
<div class="container">
    <br>
    <h1 class="text-center">Add Student</h1>
    <br>

    <form action="" method="POST">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Student ID:</th>
                <td>
                    <input type="text" name="student_id" class="form-control" placeholder="Enter student id" required>
                </td>
            </tr>
            <tr>
                <th>First Name:</th>
                <td>
                    <input type="text" name="firstname" class="form-control" placeholder="Enter first name" required>
                </td>
            </tr>
            <tr>
                <th>Last Name:</th>
                <td>
                    <input type="text" name="lastname" class="form-control" placeholder="Enter last name" required>
                </td>
            </tr>
            <tr>
                <th>Department:</th>
                <td>
                    <input type="text" name="department" class="form-control" placeholder="Enter department" required>
                </td>
            </tr>
            <tr>
                <th>Batch:</th>
                <td>
                    <input type="text" name="batch" class="form-control" placeholder="Enter batch" required>
                </td>
            </tr>
        </table>

        <div class="text-center">
            <input type="submit" name="submit" value="Add Student" class="btn-secondary btn-lg">
        </div>
    </form>

</div>

<?php
include('../../format/footer.php');

if (isset($_POST['submit'])) {
    // basic sanitising
    $student_id = (int)($_POST['student_id'] ?? 0);
    $firstname  = trim($_POST['firstname']  ?? '');
    $lastname   = trim($_POST['lastname']   ?? '');
    $department = trim($_POST['department'] ?? '');
    $batch      = trim($_POST['batch']      ?? '');

    // 1) Check for duplicate student_id
    $checkSql = "SELECT COUNT(*) AS cnt FROM student WHERE student_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $student_id);
    $checkStmt->execute();
    $checkRes  = $checkStmt->get_result();
    $row       = $checkRes->fetch_assoc();
    $checkStmt->close();

    if ($row && (int)$row['cnt'] > 0) {
        // student_id already exists
        echo "<script>alert('Student ID already exists. Please use a different ID.');</script>";
    } else {
        // 2) Insert new student
        $sql = "INSERT INTO student (student_id, firstname, lastname, department, batch)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $student_id, $firstname, $lastname, $department, $batch);
        $ok = $stmt->execute();
        $stmt->close();

        if ($ok) {
            echo "<script>
                var r = confirm('New student added. Add another student?');
                if (r === true) {
                    window.location.href='add-student.php';
                } else {
                    window.location.href='students.php';
                }
            </script>";
        } else {
            echo "<script>alert('Failed to add student.');</script>";
        }
    }
}
?>
