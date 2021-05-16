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
    //if there is a user logged in show the user_properties.php page
    //if update_btn button is clicked
    if(isset($_POST['update_btn']))
    {
        //get the data from the form
        $new_firstname = $_POST['firstname'];
        $new_lastname = $_POST['lastname'];
        $new_email = $_POST['email'];
        $new_admin_employee = $_POST['admin_employee'];

        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database 
        require_once '../includes/db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once '../includes/functions.php';

        //in the "main_admin.php" page when a user's email is clicked the admin is being 
        //redirected to "user_properties.php?email="
        //so in the link there is the email of the user 
        $email = $_GET['email'];
        
        //function update_employee in functions.php
        update_employee($con,$email,$new_firstname,$new_lastname,$new_email,$new_admin_employee);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="../css/request_signup_style.css">
</head>
<body>
<div class='title'>
    <h1>Update employee</h1>
</div>
<div class="go_back">
    <form action="main_admin.php">
        <input id="go_back" type="submit" href="main_admin.php" name='go_back' class="go_back" value="Go Back"> 
    </form>
    <br>
</div>
<div class="contact-form">
    <?php
        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database 
        require_once '../includes/db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once '../includes/functions.php';

        //in the "main_admin.php" page when a user's email is clicked the admin is being 
        //redirected to "user_properties.php?email="
        //so in the link there is the email of the user 
        $email = $_GET['email'];

        //user fields are pre-populated with the user’s entries
        //$sql consists of a SQL statemen
        $sql="SELECT * from users WHERE email='".$email."'"; 
        //mysqli_query() function performs a query against a database
        $con=  mysqli_query($con,$sql);
    ?>
    <?php
        //fetch data from 'users' table 
        while($row= mysqli_fetch_array($con))
        {
    ?>
    <form id='contact-form' method="POST" action="">
    <input name="firstname" type="text" class="form-control" value= "<?php echo $row['firstname']; ?>">
    <br>
    <input name="lastname" type="text" class="form-control" value= "<?php echo $row['lastname']; ?>">
    <br>
    <input name="email" type="email" class="form-control" value= "<?php echo $row['email']; ?>">
    <br>
    <select name="admin_employee" class="form-control" style="height: 45px;">
        <option value="admin" <?php if($row['user_type']=="admin") echo 'selected="selected"'; ?>>admin</option>                 
        <option value="employee" <?php if($row['user_type']=="employee") echo 'selected="selected"'; ?>>employee</option>                    
    </select>
    <br>
    <?php
        }
    ?>
    <form id='contact-form' method="POST" action="../includes/functions.php">
    <input type="submit" name="update_btn" class="form-control submit" value="Update"> 
    </form>
</div>
</body>
</html>


