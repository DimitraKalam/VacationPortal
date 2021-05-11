<?php

// function empty_inputs($firstname,$lastname,$email,$password,$confirm_password,$admin_employee)
// {
//     $result;

//     if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password) || empty($admin_employee))
//     {
//         $result = true; //if there are empty return true
//     }
//     else
//     {
//         $result = false;
//     }
// }

// function invalid_name($firstname,$lastname)
// {
//     $result;
//     //preg_match 
//     if(!preg_match("/^[a-zA-Z0-9]*$/",$firstname) || !preg_match("/^[a-zA-Z0-9]*$/",$lastname) )
//     {
//         $result = true; //if the firstname and lastname arent valid 
//     }
//     else
//     {
//         $result = false;
//     }
// }

// function invalid_email($email)
// {
//     $result;
//     if(!filter_var($email, FILTER_VALIDATE_EMAIL))
//     {
//         $result = true; //if the email isnt valid 
//     }
//     else
//     {
//         $result = false;
//     }
// }

function password_match($password,$confirm_password)
{
    $result;
    
    if($password !== $confirm_password)
    {
        $result = true; //if the passwords dont match 
    }
    else
    {
        $result = false;
    }
}

// https://youtu.be/gCo6JqGMi30?t=4102

function create_user($con,$firstname,$lastname,$email,$password,$admin_employee)
{
    $user_id = 1;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "insert into users (user_id,firstname,lastname,email,password,user_type) values ('$user_id','$firstname','$lastname','$email','$hashed_password','$admin_employee')";
    
    mysqli_query($con,$query);
    header("Location: ../php/main_admin.php");
    die;
}