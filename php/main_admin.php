<?php
if(isset($_POST['create_btn'])){
    header("Location: signup.php");
exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration page</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <style>
        table {
        border-collapse: collapse;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        height: 70px;
        }
        table, th, td 
        {
        border: 1px solid white;
        color: white;
        }
        th {
        background-color: #4CAF50;
        color: white;
        height: 70px;
        }
        td {
        height: 50px;
        }
    </style>
</head>
<body>
    <div class="admin_page">
        <form action="signup.php" method="POST">
            <input type="submit" name='create_btn' class="create_button" value="Create a user"> 
        </form>
    </div>
    <div class="logout">
        <form id='contact-form' action="logout.php">
            <input type="submit" href="logout.php" name='logout_btn' class="logout_btn" value="Logout"> 
        </form>
    </div>
    <br>
    </div>
    <div>
    <?php
        require_once '../includes/db_connection.php';
        require_once '../includes/functions.php';
        $sql="SELECT * from users ";
        $result= mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);
        if(!$con)
       {
           die('not connected');
       }
        $con=  mysqli_query($con, "select * from users");
       ?>
        <div class="users_table">
         <table>
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
                <td><?php echo $row['firstname']; ?></td>
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