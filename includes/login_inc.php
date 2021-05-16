<?php
//logging in the user and keeping the email as a session variable
session_start(); 
//if login button is clicked 
if(isset($_POST['login_btn']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    //email is a unique feature of each user so it is used as a session variable 
    //this way we know which user is logged in and we can retrieve data using the session variable email 
    $_SESSION['email'] = $email;
    
    //embed PHP code from php files
    //db_connection.php is used to open up a connection to my database
    //$con opens up a connection to my database 
    require_once 'db_connection.php';
    //functions.php contains functions that are used in other php files
    require_once 'functions.php';

    //if the user hasn't fill in the fields an error occurs in the url link, 
    //the error is "empty input"
    if ( empty($email) || empty($password) ) 
    {    
        header("Location: ../php/login.php?error=emptyinput");
        exit();
    }

    //function login_user in functions.php
    //$con, $email and $password are used as arguments
    //the variable $con opens up a connection to my database 
    //and it is being created in db_connection.php file
    login_user($con,$email,$password);
}
//if login button isnt't clicked
//the user is redirected to login page
else
{
    header("Location: ../php/login.php");
    exit();
}

