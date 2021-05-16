<?php

//used in signup_inc.php
//inserts data into 'users' table
function create_user($con,$firstname,$lastname,$email,$password,$admin_employee)
{   
    //$result returns true or false 
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
    else
    {
        //if the creation of the user failed return false
        $result = false;
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

    //$query consists of a SQL statement and contains a parameter marker represented by question mark (?) 
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
//returns true if the form was successfully submitted
//returns false if the form submission failed
function submit_form($con,$email,$start_date,$end_date,$reason)
{
    //$result returns true or false 
    $result;
    //$query consists of a SQL statement
    $query = "INSERT INTO request_form (request_email,start_date,end_date,reason,req_status) VALUES ('$email','$start_date','$end_date','$reason','pending')";
    
    //mysqli_query() function performs a query against a database
    //returns false on failure
    if (mysqli_query($con,$query))
    {
        //if the form was successfully submitted return true
        $result = true;
    }
    else
    {
        //if the form submission failed return false
        $result = false;
    }

}

//used in user_properties.php
//update the user’s properties in 'users' table
function update_employee($con,$email,$new_firstname,$new_lastname,$new_email,$new_admin_employee) 
{
    //$query consists of a SQL statemen
    $query = "UPDATE users 
    SET firstname='$new_firstname',lastname='$new_lastname',email='$new_email', user_type='$new_admin_employee' 
    where email='$email' ";
    //mysqli_query() function performs a query against a database
    //returns false on failure
    mysqli_query($con,$query);
    if(mysqli_query($con,$query))
    {
        //if the table was successfully updated redirect administrator to the main_admin.php page
        header("Location: ../php/main_admin.php");
        exit(); 
    } 
    else 
    {
        //otherwise echo an error
        echo 'ERROR: Not able to execute query.';
    }

}

//used in main_admin.php and main_employee.php
//returns the first name of the user who is logged in
function fetch_firstname($con,$email)
{
    //$query consists of a SQL statemen    
    $query = "SELECT firstname FROM users WHERE email = '$email' ";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $first=$row['firstname'];
    return $first;
}

//used in request_inc.php
//sends an email to the supervisor that contains the name and email of the employee who applied, 
//the start date,the end date, the reason of the vacation and 
//the links to approve or reject the application
//the links contain the user's email($email), request id($req_id) and the date of the request creation($req_date)
//the subject of the email is Submission Form
function send_email($first,$email,$start_date,$end_date,$reason,$req_id,$req_date)
{
    //the email is being sent to the supervisor
    $to_email = 'vacation.portal.email@gmail.com';
    $subject = "Submission Form";
    $message = 
    "Dear supervisor, employee " .$first. " (email: " .$email. ") requested for some time off, starting on " .$start_date. " and ending on " .$end_date. ", stating the reason: " .$reason. "
    <br>
    Click on one of the below links to approve or reject the application:<br>
    <a href='http://localhost/VacationPortal/php/accept_request.php?user_email=$email&req_id=$req_id&date=$req_date'>click here to approve the application</a> <br>
    <a href='http://localhost/VacationPortal/php/reject_request.php?user_email=$email&req_id=$req_id&date=$req_date'>click here to reject the application</a>";
    //headers needed so the approval and rejection links work
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $email_sent =mail($to_email, $subject, $message, $headers);
    // if ($email_sent == true) 
    // {
    //     //if the email was successfully sent 
    //     header("Location: ../php/main_employee.php");
    //     die;
    // } 
    // else 
    // {
    //     //otherwise
    //     echo "Email sending failed...";
    // }
    
}