<?php
session_start();
//check if there is a user logged in
if(empty($_SESSION['email']))
{
  //redirect to login page if no user is logged in
  header('Location: login.php');
  die;
}
else
{
    //if there is a user logged in show the main_employee.php page

    //embed PHP code from php files
    //db_connection.php is used to open up a connection to my database
    //$con opens up a connection to my database
    require_once '../includes/db_connection.php';
    //functions.php contains functions that are used in other php files
    require_once '../includes/functions.php';

    //$email contains the email of the user who is logged in 
    $email = $_SESSION['email'];

    //function fetch_firstname in functions.php
    //returns the first name of the user who is logged in
    $first = fetch_firstname($con,$email);
}
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
        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database
        require_once '../includes/db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once '../includes/functions.php';
        
        //list of past applications sorted by submission
        //$sql consists of a SQL statemen
        $sql="SELECT * from request_form where request_email='". $email."' ORDER BY date_created DESC";
        //mysqli_query() function performs a query against a database
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
        //fetch data from 'request_form' table 
        while($row=mysqli_fetch_array($con))
        {
    ?>
        <tr>
            <td><?php echo $row['date_created'] ;?></td>    
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <!-- calculate the difference between the start date and end date -->
            <td><?php echo floor((abs(strtotime($row['start_date']) - strtotime($row['end_date']))/(60*60*24))+1);?></td>
            <td><?php echo $row['req_status'] ;?></td>

        </tr>
    <?php
            }
    ?>
        </table>
</div>
</body>
</html>