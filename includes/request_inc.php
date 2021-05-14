<?php
session_start();   
if(isset($_POST['submit_btn']))
{

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    require_once 'db_connection.php';
    require_once 'functions.php';
    $email = $_SESSION['email'];
    $query = "SELECT firstname FROM users WHERE email = '$email' ";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $first=$row['firstname'];



    if (submit_form($con,$email,$start_date,$end_date,$reason) !== FALSE)
    {   
        $query2 = "SELECT request_id FROM request_form WHERE request_email = '$email' AND start_date ='$start_date' AND end_date = '$end_date' AND reason = '$reason' ";
        $result2 = mysqli_query($con,$query2);
        $row2=mysqli_fetch_array($result2);
        $req_id=$row2['request_id'];

        $query3 = "SELECT date_created FROM request_form WHERE request_email = '$email' AND start_date ='$start_date' AND end_date = '$end_date' AND reason = '$reason' ";
        $result3 = mysqli_query($con,$query3);
        $row3=mysqli_fetch_array($result3);
        $req_date=$row3['date_created'];


        $to_email = 'vacation.portal.email@gmail.com';
        $from = $email;
        $subject = "Submission Form";
        $message = 
        "Dear supervisor, employee " .$first. " (email: " .$email. ") requested for some time off, starting on " .$start_date. " and ending on " .$end_date. ", stating the reason: " .$reason. "
        <br>
         request id = ".$req_id. "
        <br>
        Click on one of the below links to approve or reject the application:<br>
        <a href='http://localhost/VacationPortal/php/accept_request.php?user_email=$email&req_id=$req_id&date=$req_date'>click here to approve the application</a> <br>
        <a href='http://localhost/VacationPortal/php/reject_request.php?user_email=$email&req_id=$req_id&date=$req_date'>click here to reject the application</a>";
  
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

       
        // $headers = "From: ". $from;
        $email_sent =mail($to_email, $subject, $message, $headers);
        if ($email_sent == true) {
            echo "Email successfully sent to $to_email...";
        } else {
            echo "Email sending failed...";
        }
        header("Location: ../php/main_employee.php");
        echo $req_id;
        die;
    }

}
