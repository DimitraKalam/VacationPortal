<?php
session_start();
//get the data from the url link
//the link contain the user's email($email), request id($req_id) and the date of the request creation($req_date)
$email = $_GET["user_email"];
$id = $_GET["req_id"];
$date = $_GET["date"];

//embed PHP code from php files
//db_connection.php is used to open up a connection to my database
//$con opens up a connection to my database 
require_once '../includes/db_connection.php';
//functions.php contains functions that are used in other php files
require_once '../includes/functions.php';

//$query consists of a SQL statemen
$query = "SELECT firstname FROM users WHERE email = '$email' ";
//mysqli_query() function performs a query against a database
$result = mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
//$first contains the first name of the user who applied 
$first=$row['firstname'];

//$sql consists of a SQL statemen
$sql = "UPDATE request_form SET req_status='rejected' where request_email='$email' and request_id='$id' ";
mysqli_query($con,$sql);

$to_email = 'vacation.portal.email@gmail.com';
// $from = $email;
$subject = "Submission Form Outcome";
$message = 
"Dear employee, your supervisor has rejected your application
submitted on " .$date. ". ";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// $headers = "From: ". $from;
$email_sent =mail($to_email, $subject, $message, $headers);
if ($email_sent == true) 
{
    //if the email was successfully sent 
    echo '<center><div style="margin-top: 200px;"><h1>Email successfully sent to ' .$first.'!</h1></div></center>';
} 
else 
{
    //otherwise
    echo "<h1> Email sending failed...</h1>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rejected</title>
    <link rel="stylesheet" type="text/css" href="../css/login_style.css">
</head>
<body>
    <h1>You REJECTED <?php echo $first;?> application!</h1>
</body>
</html>
