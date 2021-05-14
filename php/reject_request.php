<?php
session_start();
$email = $_GET["user_email"];
$id = $_GET["req_id"];
$date = $_GET["date"];
echo $email;
echo $id;
echo $date;
require_once '../includes/db_connection.php';
require_once '../includes/functions.php';
$query = "SELECT firstname FROM users WHERE email = '$email' ";
$result = mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$first=$row['firstname'];

$sql = "UPDATE request_form SET req_status='rejected' where request_email='$email' and request_id='$id' ";
mysqli_query($con,$sql);
if(mysqli_query($con,$query)){
    echo 'great';
     
} else {
        echo 'ERROR: ';
    }

$to_email = 'vacation.portal.email@gmail.com';
$from = $email;
$subject = "Submission Form";
$message = 
"Dear employee, your supervisor has accepted your application
submitted on " .$date. ". ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


// $headers = "From: ". $from;
$email_sent =mail($to_email, $subject, $message, $headers);
if ($email_sent == true) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}

?>
<html>
<h1>You rejected <?php echo $first;?> application</h1>
</html>