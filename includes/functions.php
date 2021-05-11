<?php


function create_user($con,$firstname,$lastname,$email,$password,$admin_employee)
{

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (user_id,firstname,lastname,email,password,user_type) VALUES ('$user_id','$firstname','$lastname','$email','$hashed_password','$admin_employee')";
    
    mysqli_query($con,$query);
    header("Location: ../php/main_admin.php");
    die;
}

function user_exists($con,$email) 
{
    $result;
    $query = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        header("Location: ../php/signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultdata = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultdata)) //true if there data 
    {
        return $row; //return the data if the user exists
    }
    else
    {
      $result = false;  
      return $result;
    }

    mysqli_stmt_close($stmt);
    
}

function login_user($con,$email,$password)
{
    $user_exists = user_exists($con,$email);

    if($user_exists == false)
    {
        header("Location: ../php/login.php?error=wronglogin");
        exit();
    }

    $hashed_pass = $user_exists["password"];
    $check_pass = password_verify($password,$hashed_pass);

    if($check_pass == false)
    {
        header("Location: ../php/login.php?error=wronglogin");
        exit();
    }
    elseif($check_pass == true)
    {
        session_start();
        $_SESSION["user_id"] = $user_exists["user_id"];
        header("Location: ../php/main_admin.php");
        exit();
    }

}
