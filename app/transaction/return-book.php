<?php
include '../../dbconnect.php';
$tran_id = $_GET['id'];
$sql = "UPDATE transaction SET status = 'returned',
date_returned = CURDATE()
 where tran_id = '$tran_id'";
$res = mysqli_query($conn, $sql);
if ($res == TRUE) {
    echo "<script> alert('Return Successful') 
        window.location.href='return.php'</script>";
} else {
    echo "<script> alert('Return Failed')
    window.location.href='borrow.php'</script";
}
