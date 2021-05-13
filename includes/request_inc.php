<?php
session_start();   
if(isset($_POST['submit_btn']))
{

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    require_once 'db_connection.php';
    require_once 'functions.php';
    $email = $_POST['email'];
    
        if (submit_form($con,$start_date,$end_date,$reason) !== FALSE)
    {    
    $to_email = 'vacation.portal.email@gmail.com';
    $from = $email;
    $subject = "Submission Form";
    $body = "Dear supervisor, employee " .$email. "requested for some time off, 
    starting on " .$start_date. " and ending on " .$end_date. ", 
    stating the reason: " .$reason. "
    Click on one of the below links to approve or reject the application:
    {approve_link} - {reject_link} ";
    $headers = "From: ". $from;
    // mail($to_email, $subject, $body, $headers);
    $email_sent =mail($to_email, $subject, $body, $from);
    if ($email_sent == true) {
        echo "Email successfully sent to $to_email...";
    } else {
        echo "Email sending failed...";
    }
    header("Location: ../php/main_employee.php");
    die;
    }

}
