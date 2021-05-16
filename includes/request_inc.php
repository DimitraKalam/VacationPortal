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
    //if there is a user logged in show the request_form.php page
    //if submit_btn button is clicked
    if(isset($_POST['submit_btn']))
    {
        //get the data from the request form 
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];

        //embed PHP code from php files
        //db_connection.php is used to open up a connection to my database
        //$con opens up a connection to my database 
        require_once 'db_connection.php';
        //functions.php contains functions that are used in other php files
        require_once 'functions.php';

        //$email contains the email of the user who is logged in 
        $email = $_SESSION['email'];

        //fetch the first name of the user who applied and save it in the variable $first
        //$query1 consists of a SQL statement
        $query1 = "SELECT firstname FROM users WHERE email = '$email' ";
        $result1 = mysqli_query($con,$query1);
        $row1=mysqli_fetch_array($result1);
        //$first contains the first name of the user who is logged in 
        $first=$row1['firstname'];

        //function submit_form in functions.php
        //inserts data into 'request_form' table
        //returns true if the form was successfully submitted
        //returns false if the form submission failed
        //$con,$email,$start_date,$end_date and $reason are used as arguments
        if (submit_form($con,$email,$start_date,$end_date,$reason) !== FALSE)
        {   
            //if the form was successfully submitted proceed
            //$query2 consists of a SQL statement
            $query2 = "SELECT request_id FROM request_form WHERE request_email = '$email' AND start_date ='$start_date' AND end_date = '$end_date' AND reason = '$reason' ";
            $result2 = mysqli_query($con,$query2);
            $row2=mysqli_fetch_array($result2);
            //$req_id contains the request id of the request
            $req_id=$row2['request_id'];

            //$query3 consists of a SQL statement
            $query3 = "SELECT date_created FROM request_form WHERE request_email = '$email' AND start_date ='$start_date' AND end_date = '$end_date' AND reason = '$reason' ";
            $result3 = mysqli_query($con,$query3);
            $row3=mysqli_fetch_array($result3);
            //$req_date contains the creation date of the request
            $req_date=$row3['date_created'];
            
            //function send_email in functions.php
            //sends an email to the supervisor that contains the name and email of the employee who applied, 
            //the start date,the end date, the reason of the vacation and 
            //the links to approve or reject the application
            //the links contain the request id($req_id) and the date of the request creation($req_date)
            //the subject of the email is Submission Form
            send_email($first,$email,$start_date,$end_date,$reason,$req_id,$req_date);

        }
        else
        {
            //if the form submission failed redirect to request_form.php
            header("Location: ../php/request_form.php");
            exit();
        }
        header("Location: ../php/main_employee.php");
        die;

    }
}
