<?php
session_start();  
if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['email'] = $email;
    
    require_once 'db_connection.php';
    require_once 'functions.php';

    if ( empty($email) || empty($password) ) 
    {
    
        header("Location: ../php/login.php?error=emptyinput");
        exit();
    }

    login_user($con,$email,$password);
}
else
{
    header("Location: ../php/login.php");
    exit();
}

