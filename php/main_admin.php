<?php
session_start();
if(empty($_SESSION['email']))
{
  //redirect to login page
  header('Location: login.php');
  die;
}
else
{
    require_once '../includes/db_connection.php';
    require_once '../includes/functions.php';
    $email = $_SESSION['email'];
    //function fetch_firstname in functions.php
    $first = fetch_firstname($con,$email);
}
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

        //list of existing users
        $sql="SELECT * from users ORDER BY user_type";
        $result= mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);
        if(!$con)
        {
           die('not connected');
        }
        $con=mysqli_query($con, $sql);
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
        while($row=mysqli_fetch_array($con))
        {
    ?>
        <tr>
            <!-- each user firstname is clickable, clicking on it takes the admin to the
            user properties page(user_properties.php) -->
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