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
        $_SESSION["user_type"] = $user_exists["user_type"];
        //check if user is admin or employee
        if($user_exists["user_type"] == "admin")
        {
            session_start();
            $_SESSION["user_id"] = $user_exists["user_id"];
            header("Location: ../php/main_admin.php");
            exit();
        }
        elseif($user_exists["user_type"] == "employee")
        {
            session_start();
            $_SESSION["user_id"] = $user_exists["user_id"];
            header("Location: ../php/main_employee.php");
            exit();  
        }

    }

}

function submit_form($con,$start_date,$end_date,$reason)
{
   
    $query = "INSERT INTO request_form (start_date,end_date,reason,req_status) VALUES ('$start_date','$end_date','$reason','pending')";
    
    mysqli_query($con,$query);
    header("Location: ../php/main_employee.php");
    die;
}

function update_employee($con,$firstname,$new_firstname,$new_lastname,$new_email,$new_admin_employee) 
{
    $query = "UPDATE users 
    SET firstname='$new_firstname',lastname='$new_lastname',email='$new_email', user_type='$new_admin_employee' 
    where firstname='$fistname' ";
    mysqli_query($con,$query);
    if(mysqli_query($con,$query)){
        echo 'Records were updated successfully.';
    } else {
        echo 'ERROR: Could not able to execute $sql. ' . mysqli_error($link);
    }
    header("Location: ../php/main_admin.php");
    die;
}

