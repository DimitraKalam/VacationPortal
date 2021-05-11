<?php
// if(isset($_POST['create_user_btn']))
// {
//  echo "works";
// }
// else
// {
//     header("Location: main_admin.php");
// }
if(isset($_POST['create_user_btn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $admin_employee = $_POST['admin_employee'];

    require_once 'db_connection.php';
    require_once 'functions.php';

    // if(empty_inputs($firstname,$lastname,$email,$password,$confirm_password,$admin_employee) !== false)
    // {
    //     header("Location: ../php/signup.php?error=emptyinput");
    //     exit();
    // }
    
    // if(invalid_name($firstname,$lastname) !== false)
    // {
    //     header("Location: ../php/signup.php?error=invalidname");
    //     exit();
    // }

        
    // if(invalid_email($email) !== false)
    // {
    //     header("Location: ../php/signup.php?error=invalidnemail");
    //     exit();
    // }

    if(password_match($password,$confirm_password) !== false)
    {
        header("Location: ../php/signup.php?error=passwordsdontmatch");
        exit();
    }

    create_user($con,$firstname,$lastname,$email,$password,$admin_employee);

    
}
else
{
    header("Location: ../php/login.php");
}