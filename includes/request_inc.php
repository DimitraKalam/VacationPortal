<?php

if(isset($_POST['submit_btn']))
{

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    
    require_once 'db_connection.php';
    require_once 'functions.php';

    submit_form($con,$start_date,$end_date,$reason);

    
}
else
{
    header("Location: ../php/login.php");
    exit();
}

