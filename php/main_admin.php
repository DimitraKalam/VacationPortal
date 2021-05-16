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
    //if there is a user logged in show the main_admin.php page

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
        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database
        require_once '../includes/db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once '../includes/functions.php';

        //list of existing users
        //$sql consists of a SQL statemen
        $sql="SELECT * from users ORDER BY user_type";
        //mysqli_query() function performs a query against a database
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
        //fetch data from 'users' table 
        while($row=mysqli_fetch_array($con))
        {
    ?>
        <tr>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <!-- each user email is clickable, clicking on it takes the admin to the
            user properties page(user_properties.php) 
            the link contains the email of the user that the administrator clicked on-->
            <td><?php echo '<a href="user_properties.php?email=' . $row['email'] . '">' . $row['email'] . '</a>' ?></td>
            <td><?php echo $row['user_type'] ;?></td>
        </tr>
    <?php
        }
    ?>
    </table>
</div>
</body>
</html>