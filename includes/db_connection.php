<?php
//php file for connection to database
$dbhost = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "vacation_db";

//$con opens up a connection to my database
if(!$con = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbname))
{
    die("failed to connect!");
}