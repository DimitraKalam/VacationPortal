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
    //if there is a user logged in show the signup.php page
    //if create a user button is clicked
    if(isset($_POST['create_user_btn']))
    {
        //get the data from the create user form 
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $admin_employee = $_POST['admin_employee'];

        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database 
        require_once 'db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once 'functions.php';

        //if the administrator hasn't fill in the fields an error occurs in the url link, 
        //the error is "empty input"
        if (empty($firstname) || empty($lastname) || empty($email) ||
        empty($password) || empty($confirm_password) || empty($admin_employee)) 
        {
        
            header("Location: ../php/signup.php?error=emptyinput");
            exit();
        }

        //if passwords don't match an error occurs in the url link, 
        //the error is "passwords dont match"
        if ($password !== $confirm_password) 
        {
            header("Location: ../php/signup.php?error=passwordsdontmatch");
            exit();  
        }
        
        //function user_exists in functions.php
        //checks if email already exists, email is a unique feature of each user
        //if the function returns false 
            //-> a user with an email as the one given as an argument DOESN’T exists(signup_inc.php)
            //so the system can complete the creation of the new user 
        //if the function returns true 
            //-> a user exists with the same email as the one given as an argument
            //so the system doesn't allow the creation of a user with an existing email
            //an error occurs in the url link, the error is "duplicate user"
        if (user_exists($con,$email) !== false)
        {
            header("Location: ../php/signup.php?error=duplicateuser");
            exit(); 
        }

        //function create_users in functions.php
        //inserts data into 'users' table
        //$con,$firstname,$lastname,$email,$password and $admin_employee are used as arguments
        //the variable $con opens up a connection to my database 
        //and it is being created in db_connection.php file 
        //if the user creation failed an error occurs in the url link, the error is "cant create user"
        if (create_user($con,$firstname,$lastname,$email,$password,$admin_employee) !== true)
        {
            header("Location: ../php/signup.php?error=cantcreateuser");
            exit(); 
        }              
    }
    else
    {
        header("Location: ../php/login.php");
        exit();
    }

}

