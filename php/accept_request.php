<?php
session_start();
$email = $_GET["user_email"];
echo $email;
require_once '../includes/db_connection.php';
require_once '../includes/functions.php';
$query = "SELECT firstname FROM users WHERE email = '$email' ";
$result = mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$first=$row['firstname'];

$sql = "UPDATE request_form SET req_status='approved' where request_email='$email' ";
mysqli_query($con,$sql);
if(mysqli_query($con,$query)){
    echo 'great';
     
} else {
        echo 'ERROR: ';
    }
?>
<html>
<h1>You approved <?php echo $first;?> application</h1>
</html>