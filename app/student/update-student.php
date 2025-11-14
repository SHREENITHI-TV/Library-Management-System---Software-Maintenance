<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>

<div class="container">
    <br>
    <h1 class="text-center">Update Student</h1>
    <br>
    <?php

    $student_id = $_GET['id'];

    $sql = "SELECT * FROM student WHERE student_id = $student_id";

    $res = mysqli_query($conn, $sql);


    if ($res == true) {

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $student_id = $row['student_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $department = $row['department'];
            $batch = $row['batch'];
        } else {
            echo "<h1> no</h1>";
        }
    }
    ?>
    <form action="" method="post">
        <table class="table table-bordered table-striped">
            <tr>
                <th scope="row">First name:</th>
                <td>
                    <input type="text" name="firstname" value="<?= $firstname ?>" class="form-control">
                </td>
            </tr>
            <tr>
                <th scope="row">Last name:</th>
                <td>
                    <input type=" text" name="lastname" value="<?= $lastname ?>" class="form-control">
                </td>
            </tr>
            <tr>
                <th scope="row">Department:</th>
                <td>
                    <input type=" text" name="department" value="<?= $department ?>" class="form-control">
                </td>
            </tr>
            <tr>
                <th scope="row">Batch:</th>
                <td>
                    <input type=" text" name="batch" value="<?= $batch ?>" class="form-control">
                </td>
            </tr>

        </table>
        <input type="hidden" name="student_id" value="<?= $student_id; ?>">
        <br>
        <div class="text-center">
            <input type="submit" name="submit" value="Save Changes" class="btn-secondary btn-lg">
        </div>
    </form>

</div>

<?php


if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $department = $_POST['department'];
    $batch = $_POST['batch'];

    $sql = "UPDATE student SET
                firstname = '$firstname',
                lastname = '$lastname',
                department = '$department',
                batch = '$batch'
                WHERE student_id = '$student_id'
                ";

    $res = mysqli_query($conn, $sql);


    if ($res == TRUE) {

        echo "<script>
            window.location.href='students.php'</script>";
    } else {

        echo "<script> alert('Student Account Update Failed')
        </script";
    }
}
?>

<?php

include('../../format/footer.php');
?>