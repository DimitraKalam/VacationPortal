<?php
session_start(); 
if(isset($_POST['update_btn']))
{
    $new_firstname = $_POST['firstname'];
    $new_lastname = $_POST['lastname'];
    $new_email = $_POST['email'];
    $new_admin_employee = $_POST['admin_employee'];

    require_once '../includes/db_connection.php';
    require_once '../includes/functions.php';

    $firstname = $_GET['firstname'];

    update_employee($con,$firstname,$new_firstname,$new_lastname,$new_email,$new_admin_employee);
    // $query = "UPDATE users 
    // SET firstname='$new_firstname',lastname='$new_lastname',email='$new_email', user_type='$new_admin_employee' 
    // where firstname='$fistname' ";
    // mysqli_query($con,$query);
    // if(mysqli_query($con,$query)){
    //     echo 'Records were updated successfully.';
    // } else {
    //     echo 'ERROR: Could not able to execute $sql. ' . mysqli_error($link);
    // }
    // header("Location: ../php/main_admin.php");
    // die;


}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>
<body>
    <div class='contact-title'>
        <h1>Insert image</h1>
        <h2>Please update</h2>
    </div>
    <div class="contact-form">
    <?php
        require_once '../includes/db_connection.php';
        require_once '../includes/functions.php';
        $firstname = $_GET['firstname'];
        $sql="SELECT * from users WHERE firstname='".$firstname."'"; 
        $result= mysqli_query($con,$sql) or die(mysqli_error());
        $rs=mysqli_fetch_array($result);
        if(!$con)
       {
           die('not connected');
       }
        $con=  mysqli_query($con,$sql);
    ?>
    <?php

        while($row=  mysqli_fetch_array($con))
        {
            ?>
            <form id='contact-form' method="POST" action="">
            <input name="firstname" type="text" class="form-control" value= "<?php echo $row['firstname']; ?>">
            <br>
            <input name="lastname" type="text" class="form-control" value= "<?php echo $row['lastname']; ?>">
            <br>
            <input name="email" type="email" class="form-control" value= "<?php echo $row['email']; ?>">
            <br>

            <!-- <input name="password" type="password" class="form-control" placeholder="Password" required>
            <br>
            <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password" required>
            <br> -->
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


