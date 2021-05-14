<?php
session_start();
require_once '../includes/db_connection.php';
require_once '../includes/functions.php';
$email = $_SESSION['email'];
//function fetch_firstname in functions.php
$first = fetch_firstname($con,$email);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Employee</title>
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
</head>
<body>
<div class="title">
    <h1 style="color:white">Welcome <?php echo $first; ?> !</h1>
</div>
<div class="logout">
    <form action="logout.php">
        <input id="logout_btn" type="submit" href="logout.php" name='logout_btn' class="logout_btn" value="Logout"> 
    </form>
</div>
<div class="submit_request">
    <form method="post" action="request_form.php">
        <input id="inside_btn" type="submit" name='submit_request' class="submit_request" value="Submit Request"> 
    </form>
    <br>
</div>
<div>
    <?php
        require_once '../includes/db_connection.php';
        require_once '../includes/functions.php';
        
        //list of past applications sorted by submission
        $sql="SELECT * from request_form where request_email='". $email."' ORDER BY date_created DESC";
        $result=mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);

        if(!$con)
        {
            die('not connected');
        }
        $con=mysqli_query($con, $sql);
    ?>
<div class="request_table">
    <table>
        <tr>
            <th>Date created</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Days requested</th>
            <th>Request status</th>
        </tr>

    <?php
        while($row=  mysqli_fetch_array($con))
        {
    ?>
        <tr>
            <td><?php echo $row['date_created'] ;?></td>    
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td><?php echo abs(floor(strtotime($row['start_date'])/(60*60*24)) - floor(strtotime($row['end_date'])/(60*60*24)));?></td>
            <td><?php echo $row['req_status'] ;?></td>

        </tr>
    <?php
            }
    ?>
        </table>
</div>
</body>
</html>