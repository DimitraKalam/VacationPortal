<?php

//used in signup_inc.php
//inserts data into 'users' table
function create_user($con,$firstname,$lastname,$email,$password,$admin_employee)
{
    $result;
    //hashing the password so in the column 'password' in 'users' table the real password isn't shown
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    //$query consist of a SQL statement
    $query = "INSERT INTO users (user_id,firstname,lastname,email,password,user_type) VALUES ('$user_id','$firstname','$lastname','$email','$hashed_password','$admin_employee')";
    
    //mysqli_query() function performs a query against a database
    //returns false on failure
    if (mysqli_query($con,$query))
    {
        //if the creation of the user was successful return true
        $result = true;
        //redirect to to main_admin.php page
        header("Location: ../php/main_admin.php");
        die;
    }
}

//used in signup_inc.php AND function login_user
//checks if email already exists in <<signup_inc.php>> - to prevent multiple users with the same email
//checks if there is a user registered in the database with the email given as an argument 
//in the function login_user - to make sure the user exists and return the data of the user in an an associative array(dictionary) of values
function user_exists($con,$email) 
{
    $result;
    //$result returns true or false 
    //$result = true
        //if a user exists with the same email as the one given as an argument(signup_inc.php)
        //if a user with the same email as the one given as an argument exists(function login_user)
    //$result = false 
        //if a user with an email as the one given as an argument DOESN’T exists(signup_inc.php)
        //if a user with the same email as the one given as an argument DOESN’T exists(function login_user)

    //$query consist of a SQL statement and contains a parameter marker represented by question mark (?) 
    $query = "SELECT * FROM users WHERE email = ?;";
    //mysqli_stmt_init() function initializes a statement and returns an object suitable for mysqli_stmt_prepare()
    //initializing the statement
    $stmt = mysqli_stmt_init($con);
    //mysqli_stmt_prepare() returns true on success
    //or false on failure and an error occurs in the url link, the error is "stmt failed"
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        header("Location: ../php/signup.php?error=stmtfailed");
        exit();
    }

    //bind parameters for markers
    //in this case there is one question mark in $query and it is a string($email) 
    mysqli_stmt_bind_param($stmt, "s", $email);
    //executing the statement
    mysqli_stmt_execute($stmt);

    //mysqli_stmt_get_result() function accepts the statement object: $stmt, 
    //retrieves the result set from the given statement and returns it
    $resultdata = mysqli_stmt_get_result($stmt);

    //mysqli_fetch_assoc() 
    //returns an associative array(dictionary) of values that corresponds to the fetched row 
    //or null if there are no more rows in result set
    if($row = mysqli_fetch_assoc($resultdata)) 
    {
        //if mysqli_fetch_assoc() returned an array
        $result = true; 
        //return the data of the user if there is a user with the email given as argument
        return $row; 
    }
    else
    {
        //if mysqli_fetch_assoc() returned null
        $result = false;  
        return $result;
    }
    //closing the statement
    mysqli_stmt_close($stmt);
    
}

//used in login_inc.php
//login the user if there is a connection to the database 
//and the email and password are correct
function login_user($con,$email,$password)
{
    //user_exists is a function in functions.php
    //user_exists returns false if a user with the same email as the one given as an argument DOESN’T exists
    $user_exists = user_exists($con,$email);
    //$user_exists is an associative array(dictionary) of values 
    //that corresponds to the fetched row of the table 'users' 
    //which contains the information of the user
    if($user_exists == false)
    {
        //a user with the same email as the one given as an argument DOESN’T exists
        //an error occurs in the url link, the error is "wrong login"
        header("Location: ../php/login.php?error=wronglogin");
        exit();
    }

    //if the user exists
    //retrieve the password from the database
    $hashed_pass = $user_exists["password"];
    //verify that the given hash matches the given password
    //returns true if the password and hash match
    //returns false if the password and hash don't match
    $check_pass = password_verify($password,$hashed_pass);

    if($check_pass == false)
    {
        //the password and hash don't match
        //an error occurs in the url link, the error is "wrong login" 
        header("Location: ../php/login.php?error=wronglogin");
        exit();
    }
    elseif($check_pass == true)
    {
        //the password and hash match
        //retrieve the user_type from the database
                // $_SESSION["user_type"] = $user_exists["user_type"];
        //check if user is an administrator or an employee
        if($user_exists["user_type"] == "admin")
        {
            //if the user is an administrator redirect to main_admin page
            session_start();
                    // $_SESSION["user_id"] = $user_exists["user_id"];
            header("Location: ../php/main_admin.php");
            exit();
        }
        elseif($user_exists["user_type"] == "employee")
        {
            //if the user is an employee redirect to main_employee page
            session_start();
                        // $_SESSION["user_id"] = $user_exists["user_id"];
            header("Location: ../php/main_employee.php");
            exit();  
        }

    }

}

//used in request_inc.php
//inserts data into 'request_form' table
function submit_form($con,$email,$start_date,$end_date,$reason)
{
    $result;
    $query = "INSERT INTO request_form (request_email,start_date,end_date,reason,req_status) VALUES ('$email','$start_date','$end_date','$reason','pending')";
    
    if (mysqli_query($con,$query))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }

}

//used in user_properties.php
//update the user’s properties
function update_employee($con,$firstname,$new_firstname,$new_lastname,$new_email,$new_admin_employee) 
{
    $query = "UPDATE users 
    SET firstname='$new_firstname',lastname='$new_lastname',email='$new_email', user_type='$new_admin_employee' 
    where firstname='$firstname' ";
    mysqli_query($con,$query);
    if(mysqli_query($con,$query))
    {
        header("Location: ../php/main_admin.php");
        exit(); 
    } 
    else 
    {
        echo 'ERROR: Not able to execute query.';
    }

}

//used in main_?.php
//fetch firstname of user who is loged in
function fetch_firstname($con,$email)
{
    $query = "SELECT firstname FROM users WHERE email = '$email' ";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $first=$row['firstname'];
    return $first;
}