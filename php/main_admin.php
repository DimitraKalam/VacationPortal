<?php
session_start(); 
if(isset($_POST['create_btn'])){
    header("Location: signup.php");
exit;
}
require_once '../includes/db_connection.php';
require_once '../includes/functions.php';
$email = $_SESSION['email'];
$query = "SELECT firstname FROM users WHERE email = '$email' ";
$result = mysqli_query($con,$query);
$row=mysqli_fetch_array($result);
$first=$row['firstname'];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Administration page</title>
    <link rel="stylesheet" type="text/css" href="../css/main_style.css">
</head>
<body>

<div class="title">
        <h1>Welcome <?php echo $first; ?> !</h1>
</div>
    <div class="admin_page">
        <form action="signup.php" method="POST">
            <input id="inside_btn" type="submit" name='create_btn' class="create_button" value="Create a user"> 
        </form>
    </div>
    <div class="logout">
        <form action="logout.php">
            <input id="logout_btn" type="submit" href="logout.php" name='logout_btn' class="logout_btn" value="Logout"> 
        </form>
    <br>
    </div>
    <div>
    <?php
        require_once '../includes/db_connection.php';
        require_once '../includes/functions.php';
        $sql="SELECT * from users";
        $result= mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);
        if(!$con)
        {
           die('not connected');
        }
        $con=  mysqli_query($con, $sql);
    ?>
    <div class="users_table">
        <table>
         <tr>
            <th>User first name</th>
            <th>User last name</th>
            <th>User email</th>
            <th>User type (employee/admin)</th>

            </tr>

        <?php

             while($row=  mysqli_fetch_array($con))
             {
                 ?>
            <tr>
                <td><?php echo '<a href="user_properties.php?firstname=' . $row['firstname'] . '">' . $row['firstname'] . '</a>' ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['user_type'] ;?></td>
            </tr>
        <?php
             }
             ?>
             </table>
    </div>
</body>
</html>