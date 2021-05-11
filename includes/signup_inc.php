<?php

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


    if (empty($firstname) || empty($lastname) || empty($email) ||
    empty($password) || empty($confirm_password) || empty($admin_employee)) 
    {
    
        header("Location: ../php/signup.php?error=emptyinput");
        exit();
    }

    if ($password !== $confirm_password) 
    {
        header("Location: ../php/signup.php?error=passwordsdontmatch");
        exit();  
    }
    
    if(!preg_match("/^[a-zA-Z0-9]*$/",$firstname) || !preg_match("/^[a-zA-Z0-9]*$/",$lastname) )
    {
        header("Location: ../php/signup.php?error=invalidname");
        exit();  
    }

    if (user_exists($con,$email) !== false)
    {
        header("Location: ../php/signup.php?error=duplicateuser");
        exit(); 
    }

    create_user($con,$firstname,$lastname,$email,$password,$admin_employee);


    
}
else
{
    header("Location: ../php/login.php");
    exit();
}


