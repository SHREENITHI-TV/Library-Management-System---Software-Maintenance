<?php
include('../../format/header.php');
include('../../format/sidebar.php');
?>
<div class="container">
    <br>
    <h1 class="text-center">Add Admin</h1>
    <br>

    <form action="" method="POST">
        <table class="table table-bordered table-striped">
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
                <th>Username:</th>
                <td>
                    <input type=" text" name="username" class="form-control" placeholder="Enter username" required>
                </td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <input type="text" name="password" class="form-control" placeholder="Enter password" required>
                </td>
            </tr>



        </table>
        <div class="text-center">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary btn-lg">
        </div>
    </form>

</div>

<?php
include('../../format/footer.php');

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO admin SET
    firstname = '$firstname',
    lastname = '$lastname',
    username = '$username',
    password = '$password'
        ";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == TRUE) {
        echo "<script> 
        window.location.href='admin.php';
        // var r = confirm('Admin added successfully. Add another admin?');
        // if (r == true) {
        //     window.location.href='add-admin.php';
        // } else {
        //     window.location.href='admin.php';
        // }
        
        </script>";
    } else {
        echo "<script> alert('Failed') 
       </script>";
    }
}

?>