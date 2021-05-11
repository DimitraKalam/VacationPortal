<?php


function create_user($con,$firstname,$lastname,$email,$password,$admin_employee)
{
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (user_id,firstname,lastname,email,password,user_type) VALUES ('$user_id','$firstname','$lastname','$email','$hashed_password','$admin_employee')";
    
    mysqli_query($con,$query);
    header("Location: ../php/main_admin.php");
    die;
}